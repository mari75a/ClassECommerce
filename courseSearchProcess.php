<?php
require "connection.php";
$txt = $_POST["txt"];
$cat = $_POST["cat"];
$lec = $_POST["lec"];
$sub = $_POST["sub"];


$query = "SELECT  *  FROM `course` INNER JOIN `teacher_has_course` ON teacher_has_course.course_course_id=course.course_id 
 INNER JOIN `teacher` ON teacher_has_course.teacher_id=teacher.id ";
$status = 0;

if (!empty($txt)) {

  $query .= " AND `first_name` LIKE '%" . $txt . "%'";
  $status = 1;
}
if ($status == 0 && $cat != 0) {
  $query .= " WHERE `category_id`='" . $cat . "'";
  $status = 1;
} else if ($status != 0 && $cat != 0) {
  $query .= " AND `category_id`='" . $cat . "'";
}
if ($status == 0 && $sub != 0) {
  $query .= " WHERE `class_id`='" . $sub . "'";
  $status = 1;
} else if ($status != 0 && $sub != 0) {
  $query .= " AND `class_id`='" . $sub . "'";
}
if ($status == 0 && $lec != 0) {
  $query .= " WHERE `lectures_id`='" . $lec . "'";
  $status = 1;
} else if ($status != 0 && $lec != 0) {
  $query .= " AND `lectures_id`='" . $lec . "'";
}

$course_rs = Database::search($query);
$course_num = $course_rs->num_rows;

for ($y = 0; $y < $course_num; $y++) {
  $course_data = $course_rs->fetch_assoc();
?>

 <!-- card -->
 <div class="card mb-3 mt-3 col-12 col-lg-4 p-2 pb-0">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-4">
                                                            <img src="<?php echo $course_data["image"] ?>" style="width: 300px;height:150px;" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="course-content ">
                                                            <div class="d-block  mb-3">
                                                                <div>
                                                                    <h3 class="txtcl"><?php echo $course_data["title"] ?></h3>
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                <p class="fs-5   text-primary fw-bold">LKR <?php echo $course_data['price'] ?>.00</p>
                                                                </div>

                                                            </div>
                                                            <div>
                                                                <a href='<?php echo "course-details.php?id=" . $course_data["course_id"]; ?>' class="col-12 btn btn-warning">Buy Now</a>
                                                                <button class="col-12 fw-bold btn btn-dark mt-2" onclick="addToCart(<?php echo $course_data['course_id']; ?>);">Add to Cart</button>
                                                            </div>





                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
<?php
}
?>