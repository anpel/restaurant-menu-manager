<table id="<?php echo $table_id; ?>" 
    <?php
        foreach ($table_head_setup as $key => $value)
        {
            echo $key.'="'.$value.'" ';
        }
    ?>
>
    <thead>
    <tr>
    <?php
        foreach ($table_row_setup as $table_row_info)
        {
            ob_start();
            echo '<th';
            $row_title = '';
            foreach($table_row_info as $key => $value)
            {
                if($key != 'title')
                {
                    echo ' '.$key.'="'.$value.'"';
                }
            }
            echo '>'.$table_row_info['title'].'</th>';
            echo ob_get_clean();
        }
    ?>
    </tr>
    </thead>
</table>
