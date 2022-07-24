<?php
require "./php-files/selectData.php";
require "./php-files/connection.php";
$allData = queryLoop("SELECT * FROM `work-data`", $con);
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>table for programming</title>
    <!-- bootstrap link -->
    <link rel="stylesheet" href="customize-bootstrap/bootstrap.css">
    <!-- my style-sheet -->
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>

<body>
  <!-- bootstrap modal that comes when data record is not successful -->
   <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-danger text-center">
            There are some errors in sending your request to database! Please try again later.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary mx-auto" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ************************************** -->
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1 id="myTitle" class="text-center rounded-3 mt-5 mb-3 text-secondary bg-dark py-3"></h1>
                <input id="inputTitle" type="text" class="form-control text-center text-primary d-none mt-5 mb-3 mx-auto" placeholder="type new title here">
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mx-auto" onclick="changeTitle(event)">Change title</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <table class="table table-striped table-primary align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle">Row</th>
                            <th scope="col" class="align-middle">Date</th>
                            <th scope="col" class="align-middle">Amount</th>
<!--                            What was done?-->
                            <th scope="col" class="align-middle">What?</th>
<!--                            Why didn't you do that?-->
                            <th scope="col" class="align-middle">Why didn't?</th>
<!--                            Days until the end-->
                            <th scope="col" class="align-middle">Days</th>
<!--                            According to program or not?-->
                            <th scope="col" class="align-middle">According</th>
                            <th scope="col" class="align-middle">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allData as $dataRow) : ?>
                        <tr>
                           <!--
                            <?php // foreach ($dataRow as $eachRow) : ?>
                               <?php // if ( strlen( $eachRow["id"] ) > 0 ) :  ?>
                                 <th><?php // echo $eachRow["id"] ?></th>
                               <?php // else : ?>
                                 <td><?php // echo $eachRow["id"] ?></td>
                            <?php // endforeach; ?>
                            -->
                            <th scope="row"><?php echo $dataRow["id"] ?></th>
                            <td>
                                <input type="date" class="form-control d-none">
                                <span><?php echo $dataRow["date"] ?></span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span><?php echo $dataRow["amount"] ?></span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span><?php echo $dataRow["what"] ?></span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span><?php echo $dataRow["why"] ?></span>
                            </td>
                            <td>
                                <input type="number" class="form-control d-none">
                                <span><?php echo $dataRow["days"] ?></span>
                            </td>
                            <td>
                                <select class="form-select d-none" aria-label="Default select example">
                                  <option selected value="Yes">Yes</option>
                                  <option value="No">No</option>
                                  <option value="Nothing do">Nothing done</option>
                                </select>
                                <span><?php echo $dataRow["according"] ?></span>
                            </td>
                            <td>
                                <button class="btn btn-primary my-2" data-row = "1" onclick="changeFunc(event)">Edit</button>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                       <!--
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <input type="date" class="form-control d-none">
                                <span>05/27/2022</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>45 minutes</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>tried to put text of one of articles to browser.</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>was done correctlly by me</span>
                            </td>
                            <td>
                                <input type="number" class="form-control d-none">
                                <span>30</span>
                            </td>
                            <td>
                                <select class="form-select d-none" aria-label="Default select example">
                                  <option selected value="Yes">Yes</option>
                                  <option value="No">No</option>
                                  <option value="Nothing do">Nothing done</option>
                                </select>
                                <span>Yes</span>
                            </td>
                            <td>
                                <button class="btn btn-primary my-2" data-row = "1" onclick="changeFunc(event)">Edit</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">2</th>
                            <td>
                                <input type="date" class="form-control d-none">
                                <span>05/27/2022</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>45 minutes</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>tried to put text of one of articles to browser.</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>was done correctlly by me</span>
                            </td>
                            <td>
                                <input type="number" class="form-control d-none">
                                <span>30</span>
                            </td>
                            <td>
                                <select class="form-select d-none" aria-label="Default select example">
                                  <option selected value="Yes">Yes</option>
                                  <option value="No">No</option>
                                  <option value="Nothing do">Nothing done</option>
                                </select>
                                <span>Yes</span>
                            </td>
                            <td>
                                <button class="btn btn-primary my-2" data-row = "2" onclick="changeFunc(event)">Edit</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">3</th>
                            <td>
                                <input type="date" class="form-control d-none">
                                <span>05/27/2022</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>45 minutes</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>tried to put text of one of articles to browser.</span>
                            </td>
                            <td>
                                <input type="text" class="form-control d-none">
                                <span>was done correctlly by me</span>
                            </td>
                            <td>
                                <input type="number" class="form-control d-none">
                                <span>30</span>
                            </td>
                            <td>
                                <select class="form-select d-none" aria-label="Default select example">
                                  <option selected value="Yes">Yes</option>
                                  <option value="No">No</option>
                                  <option value="Nothing do">Nothing done</option>
                                </select>
                                <span>Yes</span>
                            </td>
                            <td>
                                <button class="btn btn-primary my-2" data-row = "3" onclick="changeFunc(event)">Edit</button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
                <div class="d-flex border justify-content-around mt-5 p-3">
                    <button class="btn btn-outline-primary" onclick="addData()">Add row</button>
                    <button class="btn btn-warning" onclick="cleanTable()">Clean tabel</button>
                    <button class="btn btn-dark">Save as pdf</button>
                </div>
            </div>
        </div>
    </div>


    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/JS/codes.js"></script>
</body>

</html>