function handleStudentForm(options) {
  // 'views/partials/new-student.php' - path
  // http://localhost/school_project/add-student.php - action
  $("#edit").load(options.path, function () {
      $('#formm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $("#name").val());
        formData.append('phone', $("#phone").val());
        formData.append('email', $("#email").val());
        formData.append('id', $("#id").val());
        formData.append('Course', $('#course').val());
        formData.append('submit', 'submit');
        formData.append('imageUpload', $('#imageUpload').get(0).files[0])
        $.ajax({
                type: "post",
                url: options.action,
                processData: false,
                contentType: false,
                data: formData,
                success: function(result){
                  console.log(result);
              }
          });
        });
    });
}

$(document).ready(function(){
  $("#add_student_button").click(function () {
    handleStudentForm({
      path: 'views/partials/new-student.php',
      action: 'http://localhost/school_project/add-student.php'
    });
  });

  $('.edit_student_button').click(function (e) {
    var action = this.getAttribute('href');
    e.preventDefault();
    handleStudentForm({
      path: action,
      action: action
    });
  });
});
function handleCourseForm(options) {
  // 'views/partials/new-student.php' - path
  // http://localhost/school_project/add-student.php - action
  $("#edit").load(options.path, function () {
      $('#formm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $("#name").val());
        formData.append('descr', $("#descr").val());
        formData.append('id', $("#id").val());
        formData.append('id', $('#id').val());
        formData.append('submit', 'submit');
        formData.append('imageUpload', $('#imageUpload').get(0).files[0])
        $.ajax({
                type: "post",
                url: options.action,
                processData: false,
                contentType: false,
                data: formData,
                success: function(result){
                  console.log(result);
              }
          });
        });
    });
}
$(document).ready(function(){
  $("#add_course_button").click(function () {
    handleCourseForm({
      path: 'views/partials/new-course.php',
      action: 'http://localhost/school_project/add-course.php'
    });
  });

  $('.edit_course_button').click(function (e) {
    var action = this.getAttribute('href');
    e.preventDefault();
    handleCourseForm({
      path: action,
      action: action
    });
  });
});