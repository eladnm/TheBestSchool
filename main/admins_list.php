      <div class="admins_full">
            <span>Administrators:</span>
            <button class="new_admins_button" title="Add a new administrator">+</button>
 <?php $admins=Admin::find_all('name','id');
foreach($admins as $admin) {
  echo  $admin->name ."<br />";
  //echo "id: ". $admin->id . "<br />";
  echo "phone: ". $admin->phone . "<br />";
  //echo "email: ". $admin->email . "<br />";
  echo '<img src="'.$admin->image. '" height="100" width="100"><br /> ';
}