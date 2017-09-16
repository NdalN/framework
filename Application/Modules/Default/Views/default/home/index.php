<br/>
 <div class="jumbotron">
     <h1>Hello, protected world!</h1>
     <h2 style="color:#aaa !important">PHP 5.4</h2><br />
     <p>This is an example of using admin & user management tool for web site protection. It includes public and protected area. Use it as a starting point to create your web site.</p>
 </div>
 <div class="page-header">
     <h2>User Management Tool Example<small>&nbsp;A Simple Example of using User Role  Management tool!</small></h2>
 </div>
 <div class="row">
     <div class="col-md-4">
         <h2>Public</h2>
         <p>This is public area which is not protected. You can navigate this area without authentication.</p>
         <p><br /><a class="btn btn-info" href="<?=Configuration\Config::path()->AppVirtual?>">View &raquo;</a></p>
     </div><!--/col-->
     <div class="col-md-4">
         <h2>Protected &nbsp;<span style="vertical-align:top;font-size:11px;" class="label label-success">Viewer</span></h2>
         <p>This is protected area by role Viewer. You should have "Viewer" role in order to navigate this area.</p>
         <p>
             <table>
                 <tr>
                     <td style="text-align:right"><b>Login:</b></td>
                     <td>&nbsp;&nbsp;viewer@demo.com</td>
                 </tr>
                 <tr>
                     <td style="text-align:right"><b>Password:</b></td>
                     <td>&nbsp;&nbsp;viewer</td>
                 </tr>
             </table>
         </p>
         <p><br /><a class="btn btn-info" href="<?=Configuration\Config::path()->AppVirtual?>about">View &raquo;</a></p>
     </div><!--/col-->
     <div class="col-md-4">
         <h2>Protected &nbsp;<span style="vertical-align:top;font-size:11px;" class="label label-success">Editor</span></h2>
         <p>This is protected area by role Editor. You should have "Editor" role in order to navigate this area.</p>
         <p>
             <table>
                 <tr>
                     <td style="text-align:right"><b>Login:</b></td>
                     <td>&nbsp;&nbsp;editor@demo.com</td>
                 </tr>
                 <tr>
                     <td style="text-align:right"><b>Password:</b></td>
                     <td>&nbsp;&nbsp;editor</td>
                 </tr>
             </table>
         </p>
         <p><br /><a class="btn btn-info" href="<?=Configuration\Config::path()->AppVirtual?>contact">View &raquo;</a></p>
     </div><!--/col-->
 </div><!--/row-->