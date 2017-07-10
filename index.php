<?php

include 'includes/functions.php';
include 'includes/database.php'; // sets $dbh

// handle POST actions
if(!empty($_POST))
{
    if($_POST['action'] == 'category_create')
    {
        if( trim($_POST['name_en']) == "" )
        {
            exit("Category name cannot be empty.");
        }
        $sql = "INSERT INTO categories(name_en, name_gr, name_it) "
            . "VALUES(:name_en, :name_gr, :name_it);";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ":name_en" => $_POST['name_en'],
            ":name_gr" => $_POST['name_gr'],
            ":name_it" => $_POST['name_it']
        ]);
        header("Location: /index.php?action=categories");
        exit();
    }

    if($_POST['action'] == 'plate_create')
    {
        if( trim($_POST['name_en']) == "" || trim($_POST['price']) == "")
        {
            exit("Name and price are necessary to create a new plate");
        }
        $sql = "INSERT INTO plates "
            . "(category_id, name_en, name_gr, name_it, price, available) "
            . "VALUES(:category_id, :name_en, :name_gr, :name_it, :price, 1);";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ":category_id" => $_POST['category_id'],
            ":name_en" => $_POST['name_en'],
            ":name_gr" => $_POST['name_gr'],
            ":name_it" => $_POST['name_it'],
            ":price" => string2price($_POST['price'])
        ));
        header("Location: /index.php");
        exit();
    }

    if($_POST['action'] == 'plate_delete')
    {
        $sql = "DELETE FROM plates WHERE id = :id;";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount;
        if($count > 0)
        {
            echo 'Plate '. $_POST['id']. ' deleted.';
        } else {
            echo 'Could not delete plate.';
        }
    }

    if($_POST['action'] == 'category_update')
    {
        $sql = "UPDATE categories SET position = :position, name_en = :name_en,"
           . " name_gr = :name_gr, name_it = :name_it WHERE id = :id;";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':position', $_POST['position'] , PDO::PARAM_INT);
        $stmt->bindParam(':name_en', $_POST['name_en'] , PDO::PARAM_STR);
        $stmt->bindParam(':name_gr', $_POST['name_gr'] , PDO::PARAM_STR);
        $stmt->bindParam(':name_it', $_POST['name_it'] , PDO::PARAM_STR);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rows = $stmt->execute();
        echo 'Category '. $_POST['id']. ' updated.';
    }

    if($_POST['action'] == 'plate_update')
    {
        $sql = "UPDATE plates SET price = :price, name_en = :name_en, "
            . "name_gr = :name_gr, name_it = :name_it WHERE id = :id;";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(
            ':price',
            string2price($_POST['price']),
            PDO::PARAM_BOOL
        );
        $stmt->bindParam(':name_en', $_POST['name_en'], PDO::PARAM_STR);
        $stmt->bindParam(':name_gr', $_POST['name_gr'], PDO::PARAM_STR);
        $stmt->bindParam(':name_it', $_POST['name_it'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rows = $stmt->execute();
        echo 'Plate '. $_POST['id']. ' updated.';
    }

    if($_POST['action'] == 'plate_availability_update')
    {
        $sql = "UPDATE plates SET available = :available WHERE id = :id;";
        $stmt = $dbh->prepare($sql);
        $available = $_POST['available'] === 'true' ? 1 : 0;
        $stmt->bindParam(':available', $available , PDO::PARAM_INT);
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $rows = $stmt->execute();
        echo 'Plate '. $_POST['id']. ' updated.';
    }
    exit();
}


// Check GET variables
$language = 'en'; // default menu language
$allowed_languages = ['en', 'gr', 'it'];
if(isset($_GET['language']) && in_array($_GET['language'], $allowed_languages))
{
    $language = $_GET['language'];
}

$action = 'plates'; // default action
$allowed_actions = [
    'plates',
    'ajax_plates_all',
    'categories',
    'ajax_categories_all',
    'plate_create',
    'category_create',
    'get_print',
    'menu'
];
if(isset($_GET['action']) && in_array($_GET['action'], $allowed_actions))
{
    $action = $_GET['action'];
}


// Perform requested actions
if($action == 'plates') // loads empty page, actual data loaded later using AJAX
{
    include 'templates/header.php';
    include 'includes/table_setup_plates.php';
    $table_id = 'table';
    include 'templates/table.php';
    include 'templates/footer.php';
}


if($action == 'ajax_plates_all')
{
    try{
        $avaialable_plates = $dbh->query("
            SELECT plates.id, plates.name_en, plates.name_gr, plates.name_it,
            plates.price, plates.available, categories.name_en AS category_name
            FROM plates JOIN categories 
            ON plates.category_id = categories.id 
            ORDER BY categories.id;
        ")
        ->fetchAll(PDO::FETCH_ASSOC);

        $previous_category = '';
        foreach ($avaialable_plates as $key => $plate)
        {
            $avaialable_plates[$key]['price'] = 
                str_replace('.', ',', $avaialable_plates[$key]['price']);

            $avaialable_plates[$key]['removalUrl'] = '<span class="glyphicon '
                . 'glyphicon-remove" aria-hidden="true"></span><span '
                . 'class="sr-only">Delete</span>';

            $avaialable_plates[$key]['available'] = 
                (bool)$avaialable_plates[$key]['available'];

            if($plate['category_name'] == $previous_category)
            {
                $avaialable_plates[$key]['category_name'] = '';
            } else {
                $previous_category = $plate['category_name'];
            }
        }
        echo json_encode($avaialable_plates);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


if($action == 'categories') //loads empty page, actual data loaded later w/ AJAX
{
    include 'templates/header.php';
    include 'includes/table_setup_categories.php';
    $table_id = 'cat_table';
    include 'templates/table.php';
    include 'templates/footer.php';
}


if($action == 'ajax_categories_all')
{
    try{
        $categories = $dbh->query("
            SELECT *
            FROM categories 
            ORDER BY position;
        ")
        ->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($categories);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}


if($action == 'plate_create')
{
    include 'templates/header.php';
    
    try{
        $categories = $dbh->query("
            SELECT * 
            FROM categories 
            ORDER BY position;
        ")
        ->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    include 'templates/add_plate.php';
    include 'templates/footer.php';
}


if($action == 'category_create')
{
    include 'templates/header.php';
    include 'templates/add_category.php';
    include 'templates/footer.php';
}


if($action == 'menu') // wireframe, data loaded later using AJAX
{
    include 'templates/header.php';
    include 'includes/table_setup_menu.php';
    $table_id = 'menu';
    include 'templates/table.php';
    include 'templates/footer.php';
}


if($action == 'get_print')
{
    $name_field = 'name_'.$language;

    try{
        $avaialable_plates = $dbh->query("
            SELECT plates.id, plates.".$name_field." AS name, plates.price,
            plates.available, categories.".$name_field." AS category_name
            FROM plates JOIN categories 
            ON plates.category_id = categories.id 
            WHERE plates.available = 1
            ORDER BY categories.position;
        ")
        ->fetchAll(PDO::FETCH_ASSOC);

        $previous_category = '';
        foreach ($avaialable_plates as $key => $plate)
        {
            $avaialable_plates[$key]['price'] = str_replace(
                '.',
                ',',
                $avaialable_plates[$key]['price']
            );

            $avaialable_plates[$key]['price'] .= ' €';
            if($plate['category_name'] == $previous_category)
            {
                $avaialable_plates[$key]['category_name'] = '';
            } else {
                $previous_category = $plate['category_name'];
            }
        }
        echo json_encode($avaialable_plates);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


