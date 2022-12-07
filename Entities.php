<?php
//This Entity is a Student Entities with firstName and lastName and Year.
require_once('CSVHelper.php');

class Entities{

static function showStudent(){
    $students = CSVHelper::read('beatles.csv.php');
    ?>
    <table style = "margin-left: auto;
  margin-right: auto;">
    <tr>
    <th> Index </th>
    <th> Firstname </th>
    <th> Lastname </th>
    <th> Year </th>
  </tr>
    <?php
    $i=0;
    foreach ($students as $student){
        $info = preg_split ("/\,/", $student); 
        echo '<tr>';
        echo '<td>'. ($i+1) .'</td>';
        echo '<td>'. $info[0] .'</td>';
        echo '<td>'. $info[1] .'</td>';
        if (isset($info[2])){
            echo '<td>'. $info[2] .'</td>';
        }
        else{
            echo '<td> N/A </td>';
        }

        echo '</tr>';
        $i++;
    }
    ?>
    </table>
    <?php
    return;
}

static function addStudent(){
    if (isset($_POST['fname'])&&isset($_POST['lname'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $Year = $_POST['Year'];
        $add_student=[[$fname, $lname, $Year]];
        CSVHelper::write('beatles.csv.php', $add_student);
    }


    ?>


    <form method="POST">
    <h2>Create</h2>
    <div style="width: 18rem;">
      <label for="fname">First Name:</label>
      <input type="text" name="fname" class="form-control" id="exampleFormControlInput1" placeholder="Firstname" required>
    </div>

    <div style="width: 18rem;">
      <label for="lname">Last Name:</label>
      <input type="text" name="lname" class="form-control" id="exampleFormControlInput1" placeholder="Lastname" required>
    </div>

    <div style="width: 18rem;">
      <label for="Year">Year</label>
      <select id="Year" name="Year" >
        <option value="Freshamn">Freshamn</option>
        <option value="Sophomore">Sophomore</option>
        <option value="Junior">Junior</option>
        <option value="Senior">Senior</option>
</select>
    </div>


    <div>
      <button type="submit">Add Student</button>
    </div>
  </form>
  <?php
}

static function removeStudent(){
    if (isset($_POST['index'])) {
      $index = $_POST['index'];
      CSVHelper::delete('beatles.csv.php', $index-1);

    }

  ?>
    <form method="POST" style="text-align: center; margin-left: auto; margin-right: auto;">
      <div style="width: 18rem;">
        <label for="index">Index</label>
        <input type="text" name="index" class="form-control" id="exampleFormControlInput1" placeholder="0" required>
      </div>

      <div style="width: 18rem;">

        <div>
          <button type="submit">Remove</button>
        </div>
      </div>


    </form>

<?php

}

static function modifyStudent(){
  if (isset($_POST['fname'])&&isset($_POST['lname'])) {
      $ID = $_POST['ID'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $Year = $_POST['Year'];
      $add_student=[$fname, $lname, $Year];
      CSVHelper::modify('beatles.csv.php',$ID-1,$add_student);
  }


  ?>


  <form method="POST">
  <h2>Modify</h2>
  <div style="width: 18rem;">
    <label for="ID">ID:</label>
    <input type="number" name="ID" class="form-control" id="exampleFormControlInput1" placeholder="ID" required>
  </div>

  <div style="width: 18rem;">
    <label for="fname">First Name:</label>
    <input type="text" name="fname" class="form-control" id="exampleFormControlInput1" placeholder="Firstname" required>
  </div>

  <div style="width: 18rem;">
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" class="form-control" id="exampleFormControlInput1" placeholder="Lastname" required>
  </div>

  <div style="width: 18rem;">
    <label for="Year">Year</label>
    <select id="Year" name="Year" >
      <option value="Freshamn">Freshamn</option>
      <option value="Sophomore">Sophomore</option>
      <option value="Junior">Junior</option>
      <option value="Senior">Senior</option>
</select>
  </div>


  <div>
    <button type="submit">Add Student</button>
  </div>
</form>
<?php
}
}