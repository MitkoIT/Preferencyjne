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
                <?php 
                if($row->typ == 'produkt') {

                    //link do produktów w recepturach
                    ?>
                   <a href="http://10.0.0.32/receptury?idu=<?php echo $id_user; ?>&idapps=133&redirect=produkty/pokaz/<?php echo $row->id_skladnik; ?>" target="_blank"> <?php echo '['.$row->kod.']'.' '.$row->nazwa.' ['.$row->typ.']'; ?></a>
                   <?php

                }elseif($row->typ == 'polprodukt'){
                    //link do polproduktów w recepturach
                    ?>
                    <a href="http://10.0.0.32/receptury?idu=<?php echo $id_user; ?>&idapps=133&redirect=polprodukty/pokaz/<?php echo $row->id_skladnik; ?>" target="_blank"> <?php echo '['.$row->kod.']'.' '.$row->nazwa.' ['.$row->typ.']'; ?></a>
                    <?php

                } else {
                    ?>
                       <?php echo '['.$row->kod.']'.' '.$row->nazwa.' ['.$row->typ.']'; ?>
                    <?php
                }
                ?>
            
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