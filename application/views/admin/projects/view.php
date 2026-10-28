<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <?php echo form_hidden('project_id',$project->id) ?>
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s project-top-panel panel-full">
               <div class="panel-body _buttons">
                  <div class="row">
                     <div class="col-md-7 project-heading">
                        <h3 class="hide project-name"><?php echo $project->name; ?></h3>
                        <div id="project_view_name" class="pull-left">
                           <select class="selectpicker" id="project_top" data-width="100%"<?php if(count($other_projects) > 6){ ?> data-live-search="true" <?php } ?>>
                              <option value="<?php echo $project->id; ?>" selected data-content="<?php echo $project->name; ?> - <small><?php echo $project->client_data->company; ?></small>">
                                <?php echo $project->client_data->company; ?> <?php echo $project->name; ?>
                              </option>
                              <?php foreach($other_projects as $op){ ?>
                              <option value="<?php echo $op['id']; ?>" data-subtext="<?php echo $op['company']; ?>">#<?php echo $op['id']; ?> - <?php echo $op['name']; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="visible-xs">
                           <div class="clearfix"></div>
                        </div>
                        <?php echo '<div class="label pull-left mleft15 mtop8 p8 project-status-label-'.$project->status.'" style="background:'.$project_status['color'].'">'.$project_status['name'].'</div>'; ?>
                     </div>
                     <div class= "col-md-1 text-right">
                     <?php if(has_permission('projects','','edit')){ ?>
                        <a href="<?php echo admin_url('projects/project/'.$project->id);?>" class="btn btn-info"><?php echo _l('edit_project'); ?></a>
                        <?php } ?>
                              </div>
                     <div class="col-md-4 text-right">
                        <?php if(has_permission('tasks','','create')){ ?>
                        <a href="#" onclick="new_task_from_relation(undefined,'project',<?php echo $project->id; ?>); return false;" class="btn btn-info"><?php echo _l('new_task'); ?></a>
                        <?php } ?>
                        <?php
                           $invoice_func = 'pre_invoice_project';
                           ?>
                       <!-- <?php //if(has_permission('invoices','','create')){ ?>
                        <a href="#" onclick="<?php //echo $invoice_func; ?>(<?php //echo $project->id; ?>); return false;" class="invoice-project btn btn-info<?php //if($project->client_data->active == 0){echo ' disabled';} ?>"><?php //echo _l('invoice_project'); ?></a>
                        <?php// } ?> -->
                        <?php
                           $project_pin_tooltip = _l('pin_project');
                           if(total_rows(db_prefix().'pinned_projects',array('staff_id'=>get_staff_user_id(),'project_id'=>$project->id)) > 0){
                             $project_pin_tooltip = _l('unpin_project');
                           }
                           ?>
                        <div class="btn-group">
                           <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php echo _l('more'); ?> <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu dropdown-menu-right width200 project-actions">
                              <li>
                                 <a href="<?php echo admin_url('projects/pin_action/'.$project->id); ?>">
                                 <?php echo $project_pin_tooltip; ?>
                                 </a>
                              </li>
                              <!-- <1?php if(has_permission('projects','','edit')){ ?>
                              <li>
                                 <a href="<12?php echo admin_url('projects/project/'.$project->id); ?>">
                                 <1?php echo _l('edit_project'); ?>
                                 </a>
                              </li>
                              <1?php } ?> -->
                              <?php if(has_permission('projects','','create')){ ?>
                              <li>
                                 <a href="#" onclick="copy_project(); return false;">
                                 <?php echo _l('copy_project'); ?>
                                 </a>
                              </li>
                              <?php } ?>
                              <?php if(has_permission('projects','','create') || has_permission('projects','','edit')){ ?>
                              <li class="divider"></li>
                              <?php foreach($statuses as $status){
                                 if($status['id'] == $project->status){continue;}
                                 ?>
                              <li>
                                 <a href="#" data-name="<?php echo _l('project_status_'.$status['id']); ?>" onclick="project_mark_as_modal(<?php echo $status['id']; ?>,<?php echo $project->id; ?>, this); return false;"><?php echo _l('project_mark_as',$status['name']); ?></a>
                              </li>
                              <?php } ?>
                              <?php } ?>
                              <li class="divider"></li>
                              <?php if(has_permission('projects','','create')){ ?>
                              <li>
                                 <a href="<?php echo admin_url('projects/export_project_data/'.$project->id); ?>" target="_blank"><?php echo _l('export_project_data'); ?></a>
                              </li>
                              <?php } ?>
                              <?php if(is_admin()){ ?>
                              <li>
                                 <a href="<?php echo admin_url('projects/view_project_as_client/'.$project->id .'/'.$project->clientid); ?>" target="_blank"><?php echo _l('project_view_as_client'); ?></a>
                              </li>
                              <?php } ?>
                              <?php if(has_permission('projects','','delete')){ ?>
                              <li>
                                 <a href="<?php echo admin_url('projects/delete/'.$project->id); ?>" class="_delete">
                                 <span class="text-danger"><?php echo _l('delete_project'); ?></span>
                                 </a>
                              </li>
                              <?php } ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel_s project-menu-panel">
               <div class="panel-body">
                  <?php hooks()->do_action('before_render_project_view', $project->id); ?>
                  <?php $this->load->view('admin/projects/project_tabs'); ?>
               </div>
            </div>
            <?php
               if((has_permission('projects','','create') || has_permission('projects','','edit'))
                 && $project->status == 1
                 && $this->projects_model->timers_started_for_project($project->id)
                 && $tab['slug'] != 'project_milestones') {
               ?>
            <div class="alert alert-warning project-no-started-timers-found mbot15">
               <?php echo _l('project_not_started_status_tasks_timers_found'); ?>
            </div>
            <?php } ?>
            <?php
               if($project->deadline && date('Y-m-d') > $project->deadline
                && $project->status == 2
                && $tab['slug'] != 'project_milestones') {
               ?>
            <div class="alert alert-warning bold project-due-notice mbot15">
               <?php echo _l('project_due_notice', floor((abs(time() - strtotime($project->deadline)))/(60*60*24))); ?>
            </div>
            <?php } ?>
            <?php
               if(!has_contact_permission('projects',get_primary_contact_user_id($project->clientid))
                 && total_rows(db_prefix().'contacts',array('userid'=>$project->clientid)) > 0
                 && $tab['slug'] != 'project_milestones') {
               ?>
            <div class="alert alert-warning project-permissions-warning mbot15">
               <?php echo _l('project_customer_permission_warning'); ?>
            </div>
            <?php } ?>
            <div class="panel_s">
               <div class="panel-body">
                  <?php $this->load->view(($tab ? $tab['view'] : 'admin/projects/project_overview')); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<?php if(isset($discussion)){
   echo form_hidden('discussion_id',$discussion->id);
   echo form_hidden('discussion_user_profile_image_url',$discussion_user_profile_image_url);
   echo form_hidden('current_user_is_admin',$current_user_is_admin);
   }
   echo form_hidden('project_percent',$percent);
   ?>
<div id="invoice_project"></div>
<div id="pre_invoice_project"></div>
<?php $this->load->view('admin/projects/milestone'); ?>
<?php $this->load->view('admin/projects/copy_settings'); ?>
<?php $this->load->view('admin/projects/_mark_tasks_finished'); ?>
<?php init_tail(); ?>
<!-- For invoices table -->
<script>
   taskid = '<?php echo $this->input->get('taskid'); ?>';
</script>
<script>
   var gantt_data = {};
   <?php if(isset($gantt_data)){ ?>
   gantt_data = <?php echo json_encode($gantt_data); ?>;
   <?php } ?>
   var discussion_id = $('input[name="discussion_id"]').val();
   var discussion_user_profile_image_url = $('input[name="discussion_user_profile_image_url"]').val();
   var current_user_is_admin = $('input[name="current_user_is_admin"]').val();
   var project_id = $('input[name="project_id"]').val();
   if(typeof(discussion_id) != 'undefined'){
     discussion_comments('#discussion-comments',discussion_id,'regular');
   }
   $(function(){
    var project_progress_color = '<?php echo hooks()->apply_filters('admin_project_progress_color','#84c529'); ?>';
    var circle = $('.project-progress').circleProgress({fill: {
     gradient: [project_progress_color, project_progress_color]
   }}).on('circle-animation-progress', function(event, progress, stepValue) {
     $(this).find('strong.project-percent').html(parseInt(100 * stepValue) + '<i>%</i>');
   });
   });

   function discussion_comments(selector,discussion_id,discussion_type){
     var defaults = _get_jquery_comments_default_config(<?php echo json_encode(get_project_discussions_language_array()); ?>);
     var options = {
      // https://github.com/Viima/jquery-comments/pull/169
      wysiwyg_editor: {
            opts: {
                enable: true,
                is_html: true,
                container_id: 'editor-container',
                comment_index: 0,
            },
            init: function (textarea, content) {
                var comment_index = textarea.data('comment_index');
                 var editorConfig = _simple_editor_config();
                 editorConfig.setup = function(ed) {
                      textarea.data('wysiwyg_editor', ed);

                      ed.on('change', function() {
                          var value = ed.getContent();
                          if (value !== ed._lastChange) {
                            ed._lastChange = value;
                            textarea.trigger('change');
                          }
                      });

                      ed.on('keyup', function() {
                        var value = ed.getContent();
                          if (value !== ed._lastChange) {
                            ed._lastChange = value;
                            textarea.trigger('change');
                          }
                      });

                      ed.on('Focus', function (e) {
                        setTimeout(function(){
                          textarea.trigger('click');
                        }, 500)
                      });

                      ed.on('init', function() {
                        if (content) ed.setContent(content);

                        if ($('#mention-autocomplete-css').length === 0) {
                              $('<link>').appendTo('head').attr({
                                 id: 'mention-autocomplete-css',
                                 type: 'text/css',
                                 rel: 'stylesheet',
                                 href: site_url + 'assets/plugins/tinymce/plugins/mention/autocomplete.css'
                              });
                           }

                           if ($('#mention-css').length === 0) {
                              $('<link>').appendTo('head').attr({
                                 type: 'text/css',
                                 id: 'mention-css',
                                 rel: 'stylesheet',
                                 href: site_url + 'assets/plugins/tinymce/plugins/mention/rte-content.css'
                              });
                           }
                      })
                  }

                  editorConfig.toolbar = editorConfig.toolbar.replace('alignright','alignright strikethrough')
                  editorConfig.plugins[0] += ' mention';
                  editorConfig.content_style = 'span.mention {\
                     background-color: #eeeeee;\
                     padding: 3px;\
                  }';
                  var projectUserMentions = [];
                  editorConfig.mentions = {
                     source: function (query, process, delimiter) {
                           if (projectUserMentions.length < 1) {
                              $.getJSON(admin_url + 'projects/get_staff_names_for_mentions/' + project_id, function (data) {
                                 projectUserMentions = data;
                                 process(data)
                              });
                           } else {
                              process(projectUserMentions)
                           }
                     },
                     insert: function(item) {
                           return '<span class="mention" contenteditable="false" data-mention-id="'+ item.id + '">@'
                           + item.name + '</span>&nbsp;';
                     }
                  };

                var containerId = this.get_container_id(comment_index);
                tinyMCE.remove('#'+containerId);

                setTimeout(function(){
                  init_editor('#'+ containerId, editorConfig)
                },100)
            },
            get_container: function (textarea) {
                if (!textarea.data('comment_index')) {
                    textarea.data('comment_index', ++this.opts.comment_index);
                }

                return $('<div/>', {
                    'id': this.get_container_id(this.opts.comment_index)
                });
            },
            get_contents: function(editor) {
               return editor.getContent();
            },
            on_post_comment: function(editor, evt) {
               editor.setContent('');
            },
            get_container_id: function(comment_index) {
              var container_id = this.opts.container_id;
              if (comment_index) container_id = container_id + "-" + comment_index;
              return container_id;
            }
        },
      currentUserIsAdmin:current_user_is_admin,
      getComments: function(success, error) {
        $.get(admin_url + 'projects/get_discussion_comments/'+discussion_id+'/'+discussion_type,function(response){
          success(response);
        },'json');
      },
      postComment: function(commentJSON, success, error) {
        $.ajax({
          type: 'post',
          url: admin_url + 'projects/add_discussion_comment/'+discussion_id+'/'+discussion_type,
          data: commentJSON,
          success: function(comment) {
            comment = JSON.parse(comment);
            success(comment)
          },
          error: error
        });
      },
      putComment: function(commentJSON, success, error) {
        $.ajax({
          type: 'post',
          url: admin_url + 'projects/update_discussion_comment',
          data: commentJSON,
          success: function(comment) {
            comment = JSON.parse(comment);
            success(comment)
          },
          error: error
        });
      },
      deleteComment: function(commentJSON, success, error) {
        $.ajax({
          type: 'post',
          url: admin_url + 'projects/delete_discussion_comment/'+commentJSON.id,
          success: success,
          error: error
        });
      },
      uploadAttachments: function(commentArray, success, error) {
        var responses = 0;
        var successfulUploads = [];
        var serverResponded = function() {
          responses++;
            // Check if all requests have finished
            if(responses == commentArray.length) {
                // Case: all failed
                if(successfulUploads.length == 0) {
                  error();
                // Case: some succeeded
              } else {
                successfulUploads = JSON.parse(successfulUploads);
                success(successfulUploads)
              }
            }
          }
          $(commentArray).each(function(index, commentJSON) {
            // Create form data
            var formData = new FormData();
            if(commentJSON.file.size && commentJSON.file.size > app.max_php_ini_upload_size_bytes){
             alert_float('danger',"<?php echo _l("file_exceeds_max_filesize"); ?>");
             serverResponded();
           } else {
            $(Object.keys(commentJSON)).each(function(index, key) {
              var value = commentJSON[key];
              if(value) formData.append(key, value);
            });

            if (typeof(csrfData) !== 'undefined') {
               formData.append(csrfData['token_name'], csrfData['hash']);
            }
            $.ajax({
              url: admin_url + 'projects/add_discussion_comment/'+discussion_id+'/'+discussion_type,
              type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(commentJSON) {
                successfulUploads.push(commentJSON);
                serverResponded();
              },
              error: function(data) {
               var error = JSON.parse(data.responseText);
               alert_float('danger',error.message);
               serverResponded();
             },
           });
          }
        });
        }
      }
      var settings = $.extend({}, defaults, options);
    $(selector).comments(settings);
   }
</script>

<script>
   $(document).ready(function(){
      $("#employee_table").on('input', '.tamount', function () {
         var calculated_total_sum = 0;

         $("#employee_table .tamount").each(function () {
            var get_textbox_value = $(this).val();

            let result    =  get_textbox_value.replace(',','');
            let result_1  =  result.replace(',','');
            let result_2  =  result_1.replace(',','');
            let result_3  =  result_2.replace(',','');
            let amount_1  =  result_3.replace('$','');

            if ($.isNumeric(amount_1)) {
               calculated_total_sum += parseFloat(amount_1);
            }                  
         });

         let formatting_options = {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
         }

         let numberWithDollar = calculated_total_sum.toLocaleString("en-US", formatting_options);

         console.log(numberWithDollar);
         // calculated_total_sum1  = '$' + calculated_total_sum
         $("#totalAmount").val(numberWithDollar);
      });
   });
</script>

<script>
   $(document).ready(function(){
      $("#employee_table").on('input', '.tamount', function () {
            //   var calculated_total_sum = 0;
         $("#employee_table .tamount").each(function () {
            var get_textbox_value = $(this).val();

            let val = get_textbox_value;

            val = val.replace(/[^0-9\.]/g,'');
            if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseFloat(valArr[0],10)).toLocaleString();
            sendvalue = valArr.join('.');
            sent = "$" + sendvalue;
            $(this).val(sent)

            }
         });
      });
   });
</script>

<!-- js for on click filter -->
<script>
$(document).ready(function(){
    $("#categories_without_files").click(function(e){ 
      window.onbeforeunload = null; 
      e.preventDefault();
     $("#myForm").submit();
    });
});

// Calculation of Submitted API & Requested To Issue API Under Underwriting Tab ------>

$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
   // appends $ to value, validates decimal side
   // and puts cursor back in right position.
   
   // get input value
   var input_val = input.val();
   
   // don't validate empty input
   if (input_val === "") { return; }
   
   // original length
   var original_len = input_val.length;

   // initial caret position 
   var caret_pos = input.prop("selectionStart");
      
   // check for decimal
   if (input_val.indexOf(".") >= 0) {

      // get position of first decimal
      // this prevents multiple decimals from
      // being entered
      var decimal_pos = input_val.indexOf(".");

      // split number by decimal point
      var left_side = input_val.substring(0, decimal_pos);
      var right_side = input_val.substring(decimal_pos);

      // add commas to left side of number
      left_side = formatNumber(left_side);

      // validate right side
      right_side = formatNumber(right_side);
      
      // On blur make sure 2 numbers after decimal
      if (blur === "blur") {
         right_side += "00";
      }
      
      // Limit decimal to only 2 digits
      right_side = right_side.substring(0, 2);

      // join number by .
      input_val = "$" + left_side + "." + right_side;

   } else {
      // no decimal entered
      // add commas to number
      // remove all non-digits
      input_val = formatNumber(input_val);
      input_val = "$" + input_val;
      
      // final formatting
      if (blur === "blur") {
         input_val += ".00";
      }
   }
   
   // send updated string to input
   input.val(input_val);

   // put caret back in the right position
   var updated_len = input_val.length;
   caret_pos = updated_len - original_len + caret_pos;
   input[0].setSelectionRange(caret_pos, caret_pos);
}

</script>

</body>
</html>
