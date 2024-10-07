<table class="table table-sm" id="table_zk">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Numer wyrobu</th>
      <th scope="col">Czas dodania</th>
      <th scope="col">Zółta karta</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($zk_array as $row) : ?>
      <?php
      //skip if in numer is no "M"
      if (strpos($row->numer, 'M') === false) {
        continue;
      }
      ?>
    <tr>
      <th scope="row">
        <?php echo $row->id_zlecenie; ?>
      </th>
      <td>
        <a href="<?php echo base_url(); ?>show/<?php echo $row->id_zlecenie; ?>"><?php echo explode("M",$row->numer)[0]; ?></a>
      </td>
      <td>

        <?php
        $date = new DateTime($row->czas_dodania);
        echo $date->format('Y-m-d H:i:s');
        ?>

      </td>
      <td>
        <?php 
          // Wyodrębnij część numeru przed "M"
            $numer_prefix = explode("M", $row->numer)[0];

            // Tworzenie URL do pliku
            $file_url = 'http://10.0.0.121/prekreacja/mitko/' . $numer_prefix . 'M/zk-' . $numer_prefix . '.pdf';

            // Sprawdzanie, czy plik istnieje na zewnętrznym serwerze
            $headers = get_headers($file_url);

            // Sprawdzenie, czy plik istnieje na podstawie nagłówków
            if (strpos($headers[0], '200') !== false) {
                // Jeśli plik istnieje, generuj link
                echo '<a href="' . $file_url . '">zk-' . $numer_prefix . '.pdf</a>';
            } else {
                // Jeśli plik nie istnieje, możesz wyświetlić komunikat lub nic nie robić
                //sprawdz czy istnieje kopia bo jakims cudem usuwaja sie zk w niektorych przypadkach

                    // Tworzenie URL do pliku
                    $file_url = 'http://10.0.0.121/prekreacja/mitko/' . $numer_prefix . 'M/kopia-' . $numer_prefix . '.pdf';

                    // Sprawdzanie, czy plik istnieje na zewnętrznym serwerze
                    $headers = get_headers($file_url);

                    // Sprawdzenie, czy plik istnieje na podstawie nagłówków
                    if (strpos($headers[0], '200') !== false) {
                        // Jeśli plik istnieje, generuj link
                        echo '<a href="' . $file_url . '">zk-' . $numer_prefix . '.pdf</a>';
                    } else {
                        // Jeśli plik nie istnieje, możesz wyświetlić komunikat lub nic nie robić
                        echo 'Plik nie istnieje';
                    } 

            }
        ?>
      </td>
    </tr>

    <?php endforeach; ?>

  </tbody>
</table>

<script>

let table = new DataTable('#table_zk');

</script>