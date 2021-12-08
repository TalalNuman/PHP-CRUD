<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "college";
$insert = false;
$update = false;
$delete = false;
$con = mysqli_connect($server, $username, $password, $database);
// Check Connection
if ($con->connect_error) {
  die("connection failed:" . $con->connect_error);
}
if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $sql = "DELETE FROM `students` WHERE `students`.`rollno` = '$sno'";
  if ($con->query($sql)) {
    $delete = true;
  } else {
    echo
    "Error: " . $sql . "<br />" . $con->error;
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['rollnoedit'])) {
    $erollno = $_POST['rollnoedit'];
    $ename = $_POST['nameedit'];
    $eemail = $_POST['emailedit'];
    $esem = $_POST['semesteredit'];

    $sql = " UPDATE `students` SET  `name` = '$ename', `email` = '$eemail', `semester` = '$esem' WHERE `students`.`rollno` = '$erollno'";
    if ($con->query($sql)) {
      $update = true;
    } else {
      echo
      "Error: " . $sql . "<br />" . $con->error;
    }
  } else {
    $rollno = $_POST['rollno'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $semester = $_POST['semester'];
    $sql =
      "INSERT INTO `students` (`rollno`, `name`, `email`, `semester`) VALUES
('$rollno', '$name', '$email', '$semester')";
    if ($con->query($sql)) {
      $insert = true;
    } else {

      echo
      "Error: " . $sql . "<br />" . $con->error;
    }
  }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>CRUD-PHP</title>
</head>

<body class="container bg-secondary">

<!-- Alert -->
  <?php
  if ($insert) {
    echo "<div id='alert' class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>SUUCESS: </strong> Student's Data is INSERTED!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  if ($update) {
    echo "<div id='alert' class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>SUUCESS: </strong> Student's Data is UPDATED!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  if ($delete) {
    echo "<div id='alert' class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>SUUCESS: </strong> Student's Data is DELETED!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
  }
  ?>

  <center>
    <h2 class="mt-5">MY CRUD APP-PHP</h2>
  </center>
  <div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- FORM for the Updation -->
            <form action="index.php" class="rounded-3" method="post">
              <div class="mb-1">
                <h3> Roll No. <span id="id"></span> </h3>
              </div>
              <div class="mb-1 d-none">
                <label for="rollnoedit" class="form-label">Roll no.</label>
                <input type="text" name="rollnoedit" class="form-control" id="rollnoedit" />
              </div>
              <div class="mb-1">
                <label for="nameedit" class="form-label">Name</label>
                <input type="name" name="nameedit" class="form-control" id="nameedit" />
              </div>

              <div class="mb-1">
                <label for="emailedit" class="form-label">Email address</label>
                <input type="email" name="emailedit" class="form-control" id="emailedit" aria-describedby="emailHelp" />
              </div>
              <div class="mb-1">
                <label class="form-label">semester</label>
                <input type="semester" name="semesteredit" class="form-control" id="semesteredit" />
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-success">
              Save Changes
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- FORM for the Insertion -->
  <form action="index.php" class="bg-dark p-5 mt-5 text-light rounded-3" method="post">
    <div class="mb-1">
      <label class="form-label">Roll No.</label>
      <input type="text" name="rollno" class="form-control" id="rollno" />
    </div>
    <div class="mb-1">
      <label class="form-label">Name</label>
      <input type="name" name="name" class="form-control" id="name" />
    </div>

    <div class="mb-1">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
    </div>
    <div class="mb-1">
      <label class="form-label">semester</label>
      <input type="semester" name="semester" class="form-control" />
    </div>
    <button type="submit" class="btn btn-danger mt-2">Insert</button>
  </form>
<!-- TABLE -->
  <?php
  $sql = "SELECT * FROM `students`";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    echo "
    <table class='table bg-light rounded-3 table-striped mt-5'>
      <thead>
        <tr>
          <th scope='col'>Roll no#</th>
          <th scope='col'>Name</th>
          <th scope='col'>Email</th>
          <th scope='col'>Semester</th>
        </tr>
      </thead>
      <tbody>
        ";
    while ($row = $result->fetch_assoc()) {
      echo "
        <tr>
          <td class='fw-bold'>" . $row['rollno'] . "</td>
          <td>" . $row['name'] . "</td>
          <td>" . $row['email'] . "</td>
          <td>" . $row['semester'] . "</td>
          <td class='mx-5'>
            <button
            id=" . $row['rollno'] . " type='button'
              class='edit btn-sm btn-warning'
              data-bs-toggle='modal'
              data-bs-target='#staticBackdrop'
            >
              EDIT
            </button>
            <button
            id=" . $row['rollno'] . " type='button'
              class='delete btn-sm btn-danger'
            >
              Delete
            </button>
          
          </td>
        </tr>
        ";
    }
  } else {
    echo "0 results";
  } ?>
  </tbody>
  </table>
</body>
<!-- JavaScript -->
<script>

  // EDIT The Student Data
  let edits = document.getElementsByClassName("edit");
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      tr = e.target.parentNode.parentNode;
      console.log(e.target.id);
      let rollno = tr.getElementsByTagName("td")[0].innerText;
      let name = tr.getElementsByTagName("td")[1].innerText;
      let email = tr.getElementsByTagName("td")[2].innerText;
      let semester = tr.getElementsByTagName("td")[3].innerText;
      id.innerHTML = rollno;
      rollnoedit.value = rollno;
      nameedit.value = name;
      emailedit.value = email;
      semesteredit.value = semester;


      console.log(rollno, name, email, semester);
    });
  });
  // Delete the Student
  let deletes = document.getElementsByClassName("delete");
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      tr = e.target.parentNode.parentNode;
      console.log(e.target.id);
      let rollno = tr.getElementsByTagName("td")[0].innerText;
      if (confirm(`Are you sure you want to Delete ${rollno}`)) {
        window.location = `/php/index.php?delete=${rollno}`;
        // Will use POST request for Security Purpose
      }
    });
  });
</script>

</html>