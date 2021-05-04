<h2>HTML Table</h2>
<h3 id="msg"></h3>
<br/>
<h4>Filters : <?php if( !empty($data)) {foreach($data as $dte){ echo $dte.' ';}} ?></h4>
<?php  set_csrf(); ?>
<table>
  <tr> 
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td><?php echo humanize('GERMANY');?></td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td><?php echo random_string();?></td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr> 
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>
 
<form name="form" method="post" action="">
<label><strong>Enter Captcha:</strong></label><br />
<input type="text" name="captcha" />
<p><br />
<img src="<?php echo WWWROOT; ?>/captcha/rand/<?php echo rand(); ?>" id='captcha_image'>
</p>
<p>Can't read the image?
<a   href='javascript: refreshCaptcha();'>click here</a>
to refresh</p>
<input type="submit" name="submit" value="Submit">
</form>

<script>includeJS("js/common.js?v=1");</script>
