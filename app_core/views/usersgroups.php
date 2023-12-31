﻿<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/ucreauth/global.php");
    require_once(__CLS_PATH . "cls_html.php");
    require_once(__CLS_PATH . "cls_searchbox.php");
    require(__CTR_PATH . "ctr_user.php");
    	
	 //Declaramos el controlador de la vista actual el cual contiene las acciones a ejecutar
    $ctr_User=new ctr_User();
?>

<html>
 <head>
	   <?php
	       echo cls_HTML::html_js_header(__JS_PATH . "jquery-1.6.2.min.js");
	       echo cls_HTML::html_js_header(__JS_PATH . "jquery-ui-1.8.6.custom.min.js");
          echo cls_HTML::html_js_header(__JS_PATH . "jquery.betterTooltip.js");
	       echo cls_HTML::html_js_header(__JS_PATH . "functions.js");
          echo cls_HTML::html_css_header(__CSS_PATH . "style.css","screen");
	       echo cls_HTML::html_css_header(__CSS_PATH . "tooltip/theme/style_tooltip.css","screen");
	   ?>
	 <title>UCREAUTH v1.0</title>
 </head>

  <body>
        <script>
            $(document).ready(function() {
            	$('.text').betterTooltip({speed: 150, delay: 300});
            });
        </script>

	<div class="general_form_page">
		<div id="userpage">
		    <?php echo cls_HTML::html_form_tag("frm_usergroup", "","","post"); ?>
		    <fieldset class="groupbox"> <legend>GRUPOS</legend>
			    <div class="block_form">
				    <?php echo cls_HTML::html_input_hidden("txt_id",""); ?>
				    <?php echo cls_HTML::html_label_tag("Grupo de acceso:"); ?>
				    <br />
				    <?php echo cls_HTML::html_input_text("txt_groupname","txt_groupname","text",32,"","","Nombre del Grupo",1,"","","required"); ?>
				    <br /><br />
				    <?php echo cls_HTML::html_label_tag("Descripción breve:"); ?>
				    <br />
				    <?php echo cls_HTML::html_textarea(2,30,"txt_info","txt_info","textarea","",13,"","",""); ?>
				    <br /><br />
				    <?php echo cls_HTML::html_label_tag("Estado:"); ?>
				    <br />
		          <?php echo cls_HTML::html_select("cmb_status", array('A'=>'Activo', 'I'=>'Inactivo'), "cmb_status", "combo", 15, "", ""); ?>
				    <br />
				 </div>
				 <br />
				 <div class="block_form">
				    <fieldset class="groupbox"> <legend>PERMISOS</legend>
				      <div class="block_form">
				      <?php echo cls_HTML::html_check("chk_1", "check", "", 2, "", "");?>
				      <?php echo cls_HTML::html_label_tag("Agregar/Editar Usuarios"); ?>
				      <br />
				      <?php echo cls_HTML::html_check("chk_2", "check", "", 3, "", "");?>
				      <?php echo cls_HTML::html_label_tag("Agregar/Editar Grupos"); ?>
				      <br />
				      <?php echo cls_HTML::html_check("chk_3", "check", "", 4, "", "");?>
				      <?php echo cls_HTML::html_label_tag("Agregar/Editar Servicios"); ?>
				      <br />
				      <?php echo cls_HTML::html_check("chk_3", "check", "", 4, "", "");?>
				      <?php echo cls_HTML::html_label_tag("Agregar/Editar "); ?>
				      <br />
				      <?php echo cls_HTML::html_check("chk_4", "check", "", 5, "", "");?>
				      <?php echo cls_HTML::html_label_tag("Atender Solicitudes Moodle"); ?>
				      <br />
				      <?php echo cls_HTML::html_check("chk_5", "check", "", 6, "", "");?>
				      <?php echo cls_HTML::html_label_tag("Atender Solicitudes Wiki"); ?>
				      <br />
						<?php echo cls_HTML::html_check("chk_6", "check", "", 7, "", "");?>
						<?php echo cls_HTML::html_label_tag("Crear Solicitudes"); ?>
				      <br />
				      </div>
				    </fieldset> 
				 </div>
			 </fieldset> 
	 		 <div id="action_buttons_form">
			    <?php echo cls_HTML::html_input_button("submit","btn_new","btn_new","button","Nuevo",11,"","onclick=\"$('#frm_usergroup').attr('novalidate','novalidate');\""); ?>
			    <?php echo cls_HTML::html_input_button("submit","btn_save","btn_save","button","Guardar",12,"",""); ?>
			    <?php echo cls_HTML::html_input_button("submit","btn_search","btn_search","button","Buscar",13,"","onclick=\"$('#frm_usergroup').attr('novalidate','novalidate');\""); ?>
			    <br /><br />
		    </div>
		    <?php echo cls_HTML::html_form_end(); ?>
		</div>
		
      <?php
	      //Eventos click de los botones de acción
	      
		   if(isset($_POST['btn_new'])){
		   	$ctr_User->btn_new_click();
		   }
		    
		   if(isset($_POST['btn_save'])){
		   	$ctr_User->btn_save_click();
		   }

		   if(isset($_POST['btn_search'])){
		   	 $search=new cls_Searchbox();
		       echo $search->show_searchbox(__VWS_HOST_PATH . "usersgroups.php", "Búsqueda de Grupos", "&nbsp;&nbsp;Digite el nombre del grupo:", "usersgroups.php", "frm_usergroup");
		   }
		   
		   /*Procedemos a llenar el formulario con los datos traídos del formulario
		    de búsqueda */
		    
		  	if(isset($_GET['edit']) && isset($_GET['id'])){
		  		
		  		if($_GET['edit']=="1"){
		  			$usergroup_data=$ctr_Usergroup->get_usergroupdata($_GET['id']);

		  			echo "<script>
		  			         $('#txt_groupname').attr('readonly','readonly');
		  			         $('#txt_groupname').css('background','#CCC');
		  			         $('#txt_id').attr('value','" . $usergroup_data[0][0] . "');
		  			         $('#cmb_groups').attr('value','" . $usergroup_data[0][1] . "');
		  			         $('#txt_user').attr('value','" . $usergroup_data[0][2] . "');
								$('#cmb_status').attr('value','" . $usergroup_data[0][3] . "');
		  			     </script>";
		  		}
		  		
		   }else{
		  	   echo "<script>
		  	           $('#txt_id').attr('value','_NEW');   
		  	         </script>";
		   }
     ?>
    
	</div>
  </body>
 </html>
