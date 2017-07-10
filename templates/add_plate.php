<form method="POST" action="index.php">
<div class="form-group">
    <label for="name_en">Name:</label>
    <input type="text" class="form-control" id="name_en" name="name_en">
</div>
<div class="form-group">
    <label for="name_gr">Greek Name:</label>
    <input type="text" class="form-control" id="name_gr" name="name_gr">
</div>
<div class="form-group">
    <label for="name_it">Italian Name:</label>
    <input type="text" class="form-control" id="name_it" name="name_it">
</div>
<div class="form-group">
    <label for="price">Price:</label>
    <input type="text" class="form-control" id="price" name="price">
</div>
<div class="form-group">
    <label for="category">Category:</label>
    <select class="form-control" id="category" name="category_id">
        <?php
            $i = 0;
            foreach ($categories as $category) {
                if($i == 0)
                {
                    $i++;
                    echo '<option value="'.$category['id'].'" selected>'.$category['name_en'].'</option>';
                } else {
                    echo '<option value="'.$category['id'].'">'.$category['name_en'].'</option>';
                }
            }
        ?>
    </select>
</div>
<input type="hidden" name="action" id="" value="plate_create" />
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Add Plate">
</div>
</form>
