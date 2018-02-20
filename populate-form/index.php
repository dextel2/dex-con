<?php

    include '../UserActions.php';
    $message = "";

    $UserObject = new UserActions();
    $UserObject->databaseConnection('localhost','root','','cars');
    if(isset($_POST['submit'])) {
        $userID = $_POST['uid'];
        $name = $_POST['uname'];
        $nic = $_POST['nic'];
        $amount = $_POST['amount'];

        $insert = "INSERT INTO testTable VALUES ($userID,$name,$nic,$amount)";
        
        if($UserObject->dummyInsert($insert)) {
            $message = " Success ";
        }
    }
?>

<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<script>
$(document).ready(function() {
  var i = 1;
  $("#add_row").click(function() {
  $('tr').find('input').prop('disabled',true)
    $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input type='text' name='uid" + i + "'  placeholder='User ID' class='form-control input-md'/></td><td><input type='text' name='uname" + i + "' placeholder='Name' class='form-control input-md'/></td><td><input type='text' name='nic" + i + "' placeholder='NIC' class='form-control input-md'/></td><td><input type='text' name='amount" + i + "' placeholder='Amount' class='form-control input-md'/></td><td><input type='date' name='dt" + i + "' placeholder='Date' class='form-control input-md'/></td>");

    $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
    i++;
  });
});
</script>

<div class="text-center">
  <h1>PAYMENT PAGE</h1>
</div>
<hr>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th class="text-center">
              User ID
            </th>
            <th class="text-center">
              Name
            </th>
            <th class="text-center">
              NIC
            </th>
            <th class="text-center">
              Amount
            </th>

          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
          <form action="index.php" method="post">
            <td> 1 </td>
            <td> <input type="text" name='uid' placeholder='User ID' class="form-control" /> </td>
            <td> <input type="text" name='uname' placeholder='Name' class="form-control" /> </td>
            <td> <input type="text" name='nic' placeholder='NIC' class="form-control" /> </td>
            <td> <input type="text" name='amount' placeholder='Amount' class="form-control" /> </td>
           <td> <input type="submit" value="Submit" id="add_row" name="submit"> </td>
          </form>
          </tr>
          <tr id='addr1'></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>