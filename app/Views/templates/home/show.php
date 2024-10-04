<div class="row">

<div class="col-md-12">

<h2><?php echo $nr; ?></h2>

<?php 

if(!empty($skladowe))
{
    ?>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Produkt</th>
        <th scope="col">Preferencyjność</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($skladowe as $row) : ?>
        <tr>
            <th scope="row">
                <?php echo $row->id_skladnik; ?>
            </th>
            <td>
                <?php echo '['.$row->kod.']'.' '.$row->nazwa; ?>
            </td>
            <td>
                <?php
                    if(in_array($row->id_skladnik,$pref))
                    {
                        echo '<span class="badge text-bg-success">Tak</span>';
                    }
                    else
                    {
                        echo '<span class="badge text-bg-danger">Nie</span>';
                    }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <?php
}

?>

</div>

</div>