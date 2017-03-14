<?php
require 'connect.php' ;
  require 'core.php' ;
  
  if(!loggedin())
  {
    header('Location:studentlogin.php');
  }

$val=-1;
$title="";
$title=getgnameid($_GET['grp']);
if(!isset($_GET['grp'])||empty($_GET['grp']))
   header('Location:404.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Groups|Dashboard</title>
</head> 
<body>
<?php

  include 'include.inc.php';

  
  if(isgrp($_GET['grp']))
    {
      $val=$_GET['grp'];
   
    }
  else die('<br><br><center class=opts>No such group in our database</center>');
  if(ispending($_SESSION['uname'],$val)) echo("<br><br><center class=opts>Request Pending</center>");
  else if(!ismember($_SESSION['uname'],$val)) echo("<br><br><div id=sndiv><center class=opts>You are not a member of this group.<button class=\"subscr mdl-chip\" id=".$val."><span class=\"mdl-chip__text\">Subscribe</span></button></center></div>");
 
else{
?>
  <br><br>
 <button id="show-dialog" type="button"  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">POST <i class="material-icons alig">create</i></button>
  <dialog class="mdl-dialog">
    <h4 class="mdl-dialog__title">New Post</h4>
    <div class="mdl-dialog__content">
      <p>

        <div class="mdl-textfield mdl-js-textfield">
        <textarea class="mdl-textfield__input" type="text" rows= "3" id="sample5" ></textarea>
        <label class="mdl-textfield__label" for="sample5">Content</label>
        </div>

                <div class="mdl-textfield mdl-js-textfield">
        <textarea class="mdl-textfield__input" type="text" rows= "3" id="sample6" ></textarea>
        <label class="mdl-textfield__label" for="sample6">Image URL</label>
        </div>

      </p>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" class="mdl-button" id=npost>POST</button>
      <button type="button" class="mdl-button close" id=cancelb>CANCEL</button>
    </div>
  </dialog>
  <script>
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#show-dialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
      dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });
  </script>
<br><br>

<?php
$cour=$db->query("SELECT * FROM group_post where gid=$val ORDER by time DESC");

if (!$cour->num_rows)
{   
echo '<div class=opts>No posts</div>';
  //echo 'Permission granted Enjoy due '  //print_r($per);}
}


$rows=$cour->fetch_all(MYSQLI_ASSOC) ;

//  <a href=show_and_create_post.php?cid=".$cr_id."&fid=".$sn['forum_id']."&uname=".$u_name." > ".$sn['forum_name']."</a>
echo "<div id=feedspost>";
foreach($rows as $row)
{
  $ttl=$row['post_img'] ;
  $ath=$row['post_author'];
  $bdy=$row['post_body'] ;
   $gid=$row['gid'] ;

    echo " <div class=\"opts\" id=frm>".getposte($ath)." posted in <a href=clubs.php?grp=".$gid.">".getgnameid($gid)."</a> <div class=ts>".date("F jS Y H:i:s", strtotime($row['time']))."</div><br>$bdy<br>";if($ttl!="") echo "<img src=$ttl class=feedimg>";
    echo "</div><br>";

}
echo "</div>";


}

?>




    </div>
  </main>
</div>

</body>
</html>



<script type="text/javascript">
    $('.subscr').click(function(){
      
        $.post("joingrp.php", {gid:$(this).attr('id')}, function(result){
        $("#sndiv").html("<center class=opts>"+result+"</center>");
    });

       
  });

    $('#npost').click(function(){
      
        $.post("addpost.php", {dsc:$('#sample5').val(),iurl:$('#sample6').val(),gid:<?php echo $val;?>}, function(result){
        $('#cancelb').click();
        $("#feedspost").prepend(result);


        //alert(result);
    });

       
  });



</script>

