<section id="content">
    <div class="container">
        <div class="row">

            <div class="span8">
                <!-- <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Usia</th>
                            <th>RT</th>
                            <th>Dusun</th>
                            <th>Pendidikan</th>
                            <th>Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($penduduk as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['gender']; ?></td>
                                <td><?= $row['usia']; ?></td>
                                <td><?= $row['rt']; ?></td>
                                <td><?= $row['dusun']; ?></td>
                                <td><?= $row['pendidikan']; ?></td>
                                <td><?= $row['pekerjaan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> -->

                <!-- new table -->
                <table border="1" cellpadding="5">
                    <!-- <thead>
                        <tr>
                            <th>NO<th>
                            <th>JETIS<th>
                            <th>L<th>
                            <th>P<th>
                            <th>KK<th>
                            <th>W<th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td>NO</td>
                            <td>JETIS</td>
                            <td>L</td>
                            <td>P</td>
                            <td>KK</td>
                            <td>W</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Sehat <br> RT 02/RW 01</td>
                            <td>49</td>
                            <td>60</td>
                            <td>36</td>
                            <td>29</td>
                        </tr>
                        
                    </tbody>
                </table>
                <!-- akhir new table -->

                <div id="pagination">
                    <span class="all">Page 1 of 3</span>
                    <span class="current">1</span>
                    <a href="#" class="inactive">2</a>
                    <a href="#" class="inactive">3</a>
                </div>
            </div>