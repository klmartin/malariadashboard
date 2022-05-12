<style type="text/css">
    
    .tab{

        height: 48px;
        box-shadow: 0 1px 1px -8px rgb(9 9 16 / 20%);
}
.nav {
      border-bottom: 0px solid rgba(0,0,0,.12)
    }
.jss714{

    padding: 4px;
}
}
</style>

<script type="text/javascript">
    
    $(document).ready(function() {
        // add style to selected tab
        var selectedDash = "bulletin";
        $('#'+selectedDash+'').css({'border-radius': '25px','background-color':'#2c6693'})

        $('#'+selectedDash+'' ).css({'color':'white'})

    });

</script>
<div class="left-bar" style="background-color: rgb(243, 243, 243);overflow-y: auto;width: 295px;">

    <div style="padding: 22px;background-color: transparent;margin-top: 16px;" >
    
       <div>
        
        <a onclick=" showReportDiv('report')" style="border: 10px none;box-sizing: border-box;display: block;font-family: Roboto, sans-serif;cursor: pointer;    text-decoration: none;margin: 0px 8px;padding: 0px;outline: currentcolor none medium;font-size: 14px;font-weight: inherit;position: relative;color: rgba(0, 0, 0, 0.87);line-height: 16px;transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;border-radius: 5px;background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%;"> 
            <div>
                <div style="margin-left: 0px;padding: 16px 16px 16px 72px;position: relative;">
                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 0px; margin: 12px; left: 4px;">bar_chart</span>
                    <div>Reports</div>
                </div>
            </div>
        </a>


    </div>
     <div>
        
        <a onclick=" showReportDiv('template')" style="border: 10px none;box-sizing: border-box;display: block;font-family: Roboto, sans-serif;cursor: pointer;    text-decoration: none;margin: 0px 8px;padding: 0px;outline: currentcolor none medium;font-size: 14px;font-weight: inherit;position: relative;color: rgba(0, 0, 0, 0.87);line-height: 16px;transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;border-radius: 5px;background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%;"> 
            <div>
                <div style="margin-left: 0px;padding: 16px 16px 16px 72px;position: relative;">
                <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 0px; margin: 12px; left: 4px;">assignment</span>
                <div>Templates</div>
            </div>
        </div>
        </a>


    </div>

</div>


</div>

<div class="content-wrapper">
    <div class="content-area">
        <main id="report">
            <h1 class="jsx-1405635200">
             Reports
            </h1>

            <div id="std-report-content">
                <div class="jsx-559166881">
                    <div class="data-table-pager">
                        <ul class="data-table-pager--buttons">
                            <li class="data-table-pager--previous-page">
                                <i class="material-icons waves-effect data-table-pager--previous-page__disabled">navigate_before</i>
                            </li>
                            <li class="data-table-pager--next-page"><i class="material-icons waves-effect data-table-pager--next-page__disabled">navigate_next</i>
                            </li></ul>
                        </div>

                        <div class="jss1 search-input">
                            
                            <input onkeyup="searchTable() " id="searchTable1" class="searchInput " type="text" required="required">
                             <label class="searchLabel">Search</label>
                            <div class="cover"></div>
                        </div>

                            <div id="reportTable" class="d2-ui-table">
                                <div class="d2-ui-table__headers">
                                    <div class="d2-ui-table__headers__header d2-ui-table__headers__header--even">Name</div>
                                    <div class="d2-ui-table__headers__header d2-ui-table__headers__header--even"></div>

                                </div>

                                <div class="d2-ui-table__rows">
                                    <!-- start of reports loop -->
                                    <?php foreach($files as $file)  : ?>

                                    <div class="d2-ui-table__rows__row d2-ui-table__rows__row--even">

                                        <div id="editToInput<?php echo $file->id?>" onclick="javascript:window.open('<?php  echo base_url('temp/bulletin-files/').$file->path; ?>', '_blank' )" class="d2-ui-table__rows__row__column">
                                            <span title=" <?php echo $file->title ?> " style="width: 100%; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; position: absolute; word-break: break-all; overflow-wrap: break-word; top: 0px; line-height: 50px; padding-right: 1rem;"> <?php echo $file->title; ?> </span>
                                        </div>

                                        <div class="dropdown d2-ui-table__rows__row__column" style="width: 1%;">

                                              
                                              <div class="dropdown-menu dropdown-menu-right" style="position: fixed;" aria-labelledby="dropdownMenuButton">

                                               <a class="dropdown-item" style="margin-left: 0px; padding: 0px 24px 0px 64px; position: relative; cursor: pointer;font-size: 15px;font-weight: inherit;color: rgba(0, 0, 0, 0.87);line-height: 32px;white-space: nowrap;" onclick="javascript:window.open('<?php  echo base_url('temp/bulletin-files/').$file->path; ?>', '_blank' )">

                                                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 4px; margin: 0px; left: 24px;">play_arrow</span>View Resource
                                                </a>
                          <?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?> 

                                                <a onclick="editReportName(<?php echo $file->id ?>)" class="dropdown-item" style="margin-left: 0px; padding: 0px 24px 0px 64px; position: relative; cursor: pointer;font-size: 15px;font-weight: inherit;color: rgba(0, 0, 0, 0.87);line-height: 32px;white-space: nowrap;">

                                                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 4px; margin: 0px; left: 24px;">create</span>Edit Resource
                                                </a>

                                                <a class="dropdown-item" style="margin-left: 0px; padding: 0px 24px 0px 64px; position: relative; cursor: pointer;font-size: 15px;font-weight: inherit;color: rgba(0, 0, 0, 0.87);line-height: 32px;white-space: nowrap;" href=" <?php echo base_url('delete/report/'.base64_encode($file->id)) ?> ">

                                                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 4px; margin: 0px; left: 24px;">delete</span>Delete </a>

                                                    <?php } }?>
                                              </div>
                                          

                                            <button data-toggle="dropdown" style="border: 10px none; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; cursor: pointer; text-decoration: none; margin: 0px; padding: 12px; outline: currentcolor none medium; font-size: 0px; font-weight: inherit; position: relative; overflow: visible; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; width: 48px; height: 48px; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%;" tabindex="0" type="button">
                                                <div>
                                                    <span style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; overflow: hidden; pointer-events: none; z-index: 1;">
                                                    </span>
                                                <div style="position: absolute; font-family: Roboto, sans-serif; font-size: 10px; line-height: 22px; padding: 0px 8px; z-index: 3000; color: rgb(255, 255, 255); overflow: hidden; top: -10000px; border-radius: 2px; user-select: none; opacity: 0; left: -1px; transition: top 0ms cubic-bezier(0.23, 1, 0.32, 1) 450ms, transform 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms, opacity 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box;"><div style="position: absolute; left: 50%; top: 0px; transform: translate(-50%, -50%); border-radius: 50%; background-color: transparent; transition: width 0ms cubic-bezier(0.23, 1, 0.32, 1) 450ms, height 0ms cubic-bezier(0.23, 1, 0.32, 1) 450ms, backgroundColor 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; width: 0px; height: 0px;"></div><span style="position: relative; white-space: nowrap;">Actions</span>
                                            </div>
                                            <svg style="display: inline-block; color: rgba(0, 0, 0, 0.87); fill: currentcolor; height: 24px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;" viewBox="0 0 24 24">
                                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                            </svg>
                                            </div>
                                        </button>
                                    </div>
                                     </div>

                                    <?php endforeach;
                                    ?>
                                    <!-- end of reports loop -->

                                           
                                        </div>
                                <div style="display: none;"></div></div>

                                <!-- <div class="jsx-559166881 data-table-fake-row">No results have been found</div> -->

                                <div class="data-table-pager">
                                    <ul class="data-table-pager--buttons">
                                        <li class="data-table-pager--previous-page"><i class="material-icons waves-effect data-table-pager--previous-page__disabled">navigate_before</i></li><li class="data-table-pager--next-page"><i class="material-icons waves-effect data-table-pager--next-page__disabled">navigate_next</i>
                                        </li>
                                    </ul></div>

                                       <?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?> 
                                    <div class="d2-ui-button" style="color: rgba(0, 0, 0, 0.87); background-color: transparent; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 10px, rgba(0, 0, 0, 0.23) 0px 3px 10px; border-radius: 50%; display: inline-block;">
                                        <button style="border: 10px none; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: currentcolor none medium; font-size: inherit; font-weight: inherit; position: relative; vertical-align: bottom; background-color: rgb(0, 75, 160); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 56px; width: 56px; overflow: hidden; border-radius: 50%; text-align: center;" tabindex="0" type="button">
                                            <div>
                                            <div onclick="addForm()" style="transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">
                                            <svg class="" style="display: inline-block; color: rgb(255, 255, 255); fill: rgb(255, 255, 255); height: 56px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; line-height: 56px;" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path></svg>
                                        </div></div>
                                    </button>
                                </div>

                                <?php } }?>
                            </div>
                        </div>
            </main>

            <main id="template" style="display:none;">
            <h1 class="jsx-1405635200">
                Templates
            </h1>

            <div id="std-report-content">
                <div class="jsx-559166881">
                    <div class="data-table-pager">
                        <ul class="data-table-pager--buttons">
                            <li class="data-table-pager--previous-page">
                                <i class="material-icons waves-effect data-table-pager--previous-page__disabled">navigate_before</i>
                            </li>
                            <li class="data-table-pager--next-page"><i class="material-icons waves-effect data-table-pager--next-page__disabled">navigate_next</i>
                            </li></ul>
                        </div>

                       <div class="jss1 search-input">   
                            <input onkeyup="searchTable() " id="searchTable" class="searchInput " type="text" required="required">
                            <label class="searchLabel">Search</label>
                            <div class="cover"></div>
                        </div>

                            <div id="templateForm" class="d2-ui-table">
                                <div class="d2-ui-table__headers">
                                    <div class="d2-ui-table__headers__header d2-ui-table__headers__header--even">Name</div>
                                    <div class="d2-ui-table__headers__header d2-ui-table__headers__header--even"></div>
                                </div>

                                <div class="d2-ui-table__rows">

                                     <?php foreach($templates as $template)  : ?>

                                    <div class="d2-ui-table__rows__row d2-ui-table__rows__row--even">

                                        <div id="editTemplateInput<?php echo $template->id ?>"  onclick="javascript:window.open('<?php  echo base_url('temp/bulletin-template-file/').$template->path; ?>', '_blank' )" class="d2-ui-table__rows__row__column">
                                            <span title=" <?php echo $template->title ?> " style="width: 100%; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; position: absolute; word-break: break-all; overflow-wrap: break-word; top: 0px; line-height: 50px; padding-right: 1rem;"> <?php echo $template->title; ?> </span>
                                        </div>

                                        <div class="dropdown d2-ui-table__rows__row__column" style="width: 1%;">

                                            <!-- Options Menu -->
                                             <div class="dropdown-menu dropdown-menu-right" style="position: fixed;" aria-labelledby="dropdownMenuButton">

                                                <a class="dropdown-item" style="margin-left: 0px; padding: 0px 24px 0px 64px; position: relative; cursor: pointer;font-size: 15px;font-weight: inherit;color: rgba(0, 0, 0, 0.87);line-height: 32px;white-space: nowrap;" onclick="javascript:window.open('<?php  echo base_url('temp/bulletin-template-file/').$template->path; ?>', '_blank' )">

                                                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 4px; margin: 0px; left: 24px;">play_arrow</span>View Resource
                                                </a>
                                             <?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?> 
                                                 <a onclick="editTemplateName(<?php echo $template->id ?>)" class="dropdown-item" style="margin-left: 0px; padding: 0px 24px 0px 64px; position: relative; cursor: pointer;font-size: 15px;font-weight: inherit;color: rgba(0, 0, 0, 0.87);line-height: 32px;white-space: nowrap;" >

                                                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 4px; margin: 0px; left: 24px;">create</span>Edit Resource
                                                </a>

                                                <a class="dropdown-item" style="margin-left: 0px; padding: 0px 24px 0px 64px; position: relative; cursor: pointer;font-size: 15px;font-weight: inherit;color: rgba(0, 0, 0, 0.87);line-height: 32px;white-space: nowrap;" href=" <?php echo base_url('delete/template/'.base64_encode($template->id)) ?>">

                                                    <span class="material-icons" color="#757575" style="color: rgb(117, 117, 117); position: absolute; font-size: 24px; display: block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 24px; width: 24px; top: 4px; margin: 0px; left: 24px;">delete</span>Delete </a>

                                                    <?php } }?>
                                              </div>
                                            <!-- End of options Menu -->

                                            <button  data-toggle="dropdown" style="border: 10px none; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; cursor: pointer; text-decoration: none; margin: 0px; padding: 12px; outline: currentcolor none medium; font-size: 0px; font-weight: inherit; position: relative; overflow: visible; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; width: 48px; height: 48px; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%;" tabindex="0" type="button"><div><span style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; overflow: hidden; pointer-events: none; z-index: 1;"></span>
                                                <div style="position: absolute; font-family: Roboto, sans-serif; font-size: 10px; line-height: 22px; padding: 0px 8px; z-index: 3000; color: rgb(255, 255, 255); overflow: hidden; top: -10000px; border-radius: 2px; user-select: none; opacity: 0; left: -1px; transition: top 0ms cubic-bezier(0.23, 1, 0.32, 1) 450ms, transform 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms, opacity 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box;"><div style="position: absolute; left: 50%; top: 0px; transform: translate(-50%, -50%); border-radius: 50%; background-color: transparent; transition: width 0ms cubic-bezier(0.23, 1, 0.32, 1) 450ms, height 0ms cubic-bezier(0.23, 1, 0.32, 1) 450ms, backgroundColor 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; width: 0px; height: 0px;"></div><span style="position: relative; white-space: nowrap;">Actions</span></div><svg style="display: inline-block; color: rgba(0, 0, 0, 0.87); fill: currentcolor; height: 24px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                                            </div>
                                        </button>
                                    </div>
                                     </div>

                                    <?php endforeach;
                                    ?>
                                    <!-- end of reports loop -->

                                
                                </div>


                                <div style="display: none;"></div></div>

                                <!-- <div class="jsx-559166881 data-table-fake-row">No results have been found</div> -->

                                <div class="data-table-pager">
                                    <ul class="data-table-pager--buttons">
                                        <li class="data-table-pager--previous-page"><i class="material-icons waves-effect data-table-pager--previous-page__disabled">navigate_before</i></li><li class="data-table-pager--next-page"><i class="material-icons waves-effect data-table-pager--next-page__disabled">navigate_next</i>
                                        </li>
                                    </ul></div>

                                <?php if (isset($_SESSION["admin"])){ if($_SESSION["admin"]){ ?> 
                                    <div class="d2-ui-button" style="color: rgba(0, 0, 0, 0.87); background-color: transparent; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 10px, rgba(0, 0, 0, 0.23) 0px 3px 10px; border-radius: 50%; display: inline-block;">
                                        <button style="border: 10px none; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: currentcolor none medium; font-size: inherit; font-weight: inherit; position: relative; vertical-align: bottom; background-color: rgb(0, 75, 160); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 56px; width: 56px; overflow: hidden; border-radius: 50%; text-align: center;" tabindex="0" type="button">
                                            <div>
                                            <div onclick="addForm()" style="transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">
                                            <svg class="" style="display: inline-block; color: rgb(255, 255, 255); fill: rgb(255, 255, 255); height: 56px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; line-height: 56px;" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path></svg>
                                        </div></div>
                                    </button>
                                </div>
                                <?php } }?>
                            </div>
                        </div>

               
        </main>

       <main id="add-new-report-form" style="display:none;">
        <h1 class="jsx-1405635200"><span id="back-button" role="button" tabindex="0" class="jsx-1405635200 material-icons back-button">arrow_back</span>

           <div id="reptem"> Import report </div>
            <a href="https://docs.dhis2.org/2.34/en/user/html/using_reporting_standard_reports.html" target="_blank" rel="noopener noreferrer" class="jsx-1199280612 helper-icon material-icons">help</a>
        </h1>
        <div class="jss687 jss690 jss688 jss686 jsx-2165642276">
            <form id="newReportForm" method="post" action="<?php echo base_url('save/report') ?>" enctype="multipart/form-data">
                <section class="jsx-232685539"><h2 class="jsx-4079111950">Details</h2>
                    <div class="jsx-1762692579">
                        <div class="jss317 jsx-516171561">
                            <!-- <label class="jss332 jss321 jss326 jss329" data-shrink="false" for="name">Name*</label> -->

                        <div class="jss1 search-input">
                            
                            <input aria-invalid="false" class="searchInput" name="name" id="name" type="text" value="">


                             <label class="searchLabel">Name</label>
                            <div class="cover"></div>
                        </div>
                            <input required type="hidden" id="reportType" value="report" name="reportType" >
                           
                           <!--  <p class="jss714">
                                <span class="jsx-1725314990"></span>
                            </p> -->
                        </div>
                    </div>


               <div class="row">
                    <div class="col-xs-6">
                        <div class="jsx-1568741591">
                            <div class="jss317">  
                                <p class="jss714">
                                    <label for="userfile" class="jsx-1568741591">
                                        <span class="jss766 jss740 jss751 jss754" tabindex="0" role="button">
                                            <span class="jss741">Select file</span>
                                            <span class="jss769"></span></span>
                                        </label>
                                    </p>
                                    <input required  style="display: none" name="userfile" id="userfile" type="file" class="jsx-1568741591" value="">
                                <p class="jss714" id="report_file_name">

                                </p>
                                    
                                </div>
                            </div>
                        </div>
                       
                        </div>
                    </section>
                    
                <span class="jsx-3902943628"><div class="d2-ui-button" style="color: rgba(0, 0, 0, 0.87); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px, rgba(0, 0, 0, 0.12) 0px 1px 4px; border-radius: 2px; display: inline-block; min-width: 88px;">
                    <button type="submit" style="border: 10px none; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: currentcolor none medium; font-size: inherit; font-weight: inherit; position: relative; height: 36px; line-height: 36px; width: 100%; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; background-color: rgb(0, 75, 160); text-align: center;" tabindex="0" type="button"><div>
                        <div style="height: 36px; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;"><span style="position: relative; opacity: 1; font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Submit</span>
                        </div>
                    </div>
                </button>
            </div>
        </span>
        <span class="jsx-3902943628">
            <div class="d2-ui-button" style="color: rgba(0, 0, 0, 0.87); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px, rgba(0, 0, 0, 0.12) 0px 1px 4px; border-radius: 2px; display: inline-block; min-width: 88px;">
            <button style="border: 10px none; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: currentcolor none medium; font-size: inherit; font-weight: inherit; position: relative; height: 36px; line-height: 36px; width: 100%; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; background-color: rgb(255, 255, 255); text-align: center;" tabindex="0" type="button">
                <div>
                    <div style="height: 36px; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">
                        <span style="position: relative; opacity: 1; font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgba(0, 0, 0, 0.87);">Cancel</span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </span>
                    </form>
                </div>
    </main>
    </div>
</div>

<?php if (isset($msg))  { ?>

    <script>
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: ' <?php echo str_replace('%20', ' ', $msg) ?> ',
          showConfirmButton: false,
          timer: 2000,
          iconColor:'#2c6693',
        })
    </script>
    
<?php } ?>




<script>


$('#userfile').on('change', function() {

 $('#report_file_name').empty()
 $('#report_file_name').append($('#userfile').val().split(/(\\|\/)/g).pop());

 // console.log($('#userfile').val());
});
    var selected = "report";

    function showReportDiv(text){

        if (text ==='template') {
            selected = "template";
            $("#add-new-report-form").hide()
            $("#report").hide()
            $("#template").show()
        }
       else{
            selected = "report";
            $("#add-new-report-form").hide()
            $("#template").hide()
            $("#report").show()
        }

    }

    function addForm(){

        $("#report").hide()
        $("#template").hide()
        $("#reportType").val(selected)
        $("#reptem").text('Import '+selected)
        $("#add-new-report-form").show()

    }

    function editReportName(id) {
          // body...
        $("#editToInput"+id).html('<input aria-invalid="false" id="name'+id+'" onfocusout="sendNewFileName('+id+')" type="text" value="">')
        $("#editToInput"+id).removeAttr('onclick')
    }

    function editTemplateName(id) {
        console.log( $("#editTemplateInput"+id))
          // body...
        $("#editTemplateInput"+id).html('<input aria-invalid="false" id="name'+id+'" onfocusout="sendNewTemplateName('+id+')" type="text" value="">')
        $("#editTemplateInput"+id).removeAttr('onclick')
      
    }

    function sendNewTemplateName(id) {

        $.ajax({
            url:'<?php echo base_url()?>edit/template',
            type:'POST',
            data:{
                id:id,
                newTitle:$("#name"+id).val()
            },
            success: function(data) {
                let link ='<?php echo base_url() ?>'+'temp/bulletin-files/'+data.replaceAll('"', "");
                var html = '<div id="editTemplateInput'+id+'" onclick="javascript:window.location.href="'+link+'" class="d2-ui-table__rows__row__column">'+
                                            '<span title="  " style="width: 100%; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; position: absolute; word-break: break-all; overflow-wrap: break-word; top: 0px; line-height: 50px; padding-right: 32rem;"> '+$("#name"+id).val()+' </span>'+
                                        '</div>'
                $("#editTemplateInput"+id).html(html)

            }
        })
       
        // body...
    }

    function sendNewFileName(id) {

        $.ajax({
            url:'<?php echo base_url()?>edit/report',
            type:'POST',
            data:{
                id:id,
                newTitle:$("#name"+id).val()
            },
            success: function(data) {
                let link ='<?php echo base_url() ?>'+'temp/bulletin-files/'+data.replaceAll('"', "");
                var html = '<div id="editToInput'+id+'" onclick="javascript:window.location.href="'+link+'" class="d2-ui-table__rows__row__column">'+
                                            '<span title="  " style="width: 100%; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; position: absolute; word-break: break-all; overflow-wrap: break-word; top: 0px; line-height: 50px; padding-right: 32rem;"> '+$("#name"+id).val()+' </span>'+
                                        '</div>'
                $("#editToInput"+id).html(html)

            }
        })
       
        // body...
    }

    function searchTable() 
    {
        var keyword = $("#searchTable1").val();
        var keyword2 = $("#searchTable").val();

        var filteredInput = keyword.toUpperCase();
        // form report table
        var filteredInput2 = keyword2.toUpperCase();
        // for template table
       
        var select = $("#reportTable").find('.d2-ui-table__rows').children();
        // for report table select each row and get it text

        for (var i = 0; i < select.length; i++) {
                for (var i = 0; i < select.length; i++) {
                    var txt = select[i].childNodes[1].childNodes[1].innerText
                    if (txt.toUpperCase().indexOf(filteredInput) > -1) {
                       //show
                       $(select[i]).show(); 
                    }
                    else {
                        //hide
                        $(select[i]).hide(); 
                    }
                }
           

        }
        var select2 = $("#templateForm").find('.d2-ui-table__rows').children();
        // for report table select each row and get it text
        for (var i = 0; i < select2.length; i++) {
                for (var i = 0; i < select2.length; i++) {
                    var txt = select2[i].childNodes[1].childNodes[1].innerText
                    if (txt.toUpperCase().indexOf(filteredInput2) > -1) {
                       //show
                       $(select2[i]).show(); 
                    }
                    else {
                        //hide
                        $(select2[i]).hide(); 
                    }
                }
        }
        // body...
    }

    $("#back-button").click(function(){
        $("#add-new-report-form").hide()
        $("#report").show()
    })

   


</script>

<style>
.searchInput{
    width: 100%;
    background: none;
    margin: 1.5rem 0;
    border: none;
    color: #aaa;
    font-size: 1.125rem;
    flex-direction: column;
    vertical-align: top;
    display: inline-flex;
    border: 1px solid #dbdfea;
    border-top-color: white;
    border-left-color: white;
    border-right-color: white
      }
.searchInput:focus{
    background: none;
    outline: 0;
}
.searchLabel{
    position: absolute;
    opacity: 0.6;
    font-size: 1rem;
    left: 1rem;
    pointer-events: none;
    color: #494949;
    transition: all .22s;
    top: 50%;
    transform: translateY(-50%);
    display: block;
}
.searchInput:focus + .searchLabel,
.searchInput:hover + .searchLabel,
.searchInput:valid + .searchLabel{
    top: 0;
    font-size: 1.2rem;
    transform: translateY(0);
    left: 0;
    opacity: 1;
}
.cover{
    width: 100%;
    position: absolute;
    background: none;
    height: 4px;
    top: 1.25rem;
      } 
.back-button.jsx-1405635200 {
    cursor: pointer;
    outline: currentcolor none medium;
    padding: 12px;
}

.left-bar{
    position: fixed;
    bottom: 0px;
    top: 0px;
    left: 0px;
    margin-top: 3rem;

}
.content-wrapper{
    margin-left: 295px;
}
.content-area{
    padding: 1rem 20px 20px;
}
.jsx-1405635200{
    margin-bottom: 0px;
}
h1 {
    font-size: 24px;
    font-weight: 300;
    letter-spacing: 1.2px;
    color: rgba(0, 0, 0, 0.87);
    display: flex;
    -moz-box-align: center;
    align-items: center;
    height: 48px;
}
div.jsx-559166881 > .data-table-pager {
    float: right;
    padding-top: 8px;
}
.data-table-pager--buttons {
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    list-style: none;
    padding: 0;
    text-align: right;
}
.data-table-pager--buttons li {
    display: inline-block;
}
.data-table-pager--buttons .data-table-pager--next-page .data-table-pager--next-page__disabled, .data-table-pager--buttons .data-table-pager--next-page .data-table-pager--previous-page__disabled, .data-table-pager--buttons .data-table-pager--previous-page .data-table-pager--next-page__disabled, .data-table-pager--buttons .data-table-pager--previous-page .data-table-pager--previous-page__disabled {
    color: #ccc;
}
.data-table-pager--buttons .data-table-pager--next-page, .data-table-pager--buttons .data-table-pager--previous-page {
    padding: 0;
}
.data-table-pager--buttons li {
    display: inline-block;
}
.jss1 {
    margin: 0;
    border: 0;
    display: inline-flex;
    padding: 0;
    position: relative;
    min-width: 0;
    flex-direction: column;
    vertical-align: top;
}
.jss13 {
    transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms,transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
}
.jss10 {
    top: 0;
    left: 0;
    position: absolute;
    transform: translate(0, 24px) scale(1);
}
.jss5 {
    transform-origin: top left;
}
.jss16 {
    color: #494949;
    padding: 0;
    font-size: 1rem;
    font-family: Roboto, Helvetica, Arial, sans-serif;
    line-height: 1;
}
label + .jss24 {
    margin-top: 16px;
}
.jss23 {
    position: relative;
}
.jss36 {
    color: #000000;
    cursor: text;
    display: inline-flex;
    font-size: 1rem;
    font-family: Roboto, Helvetica, Arial, sans-serif;
    line-height: 1.1875em;
    align-items: center;
}
.jss50 {
    -moz-appearance: textfield;
    -webkit-appearance: textfield;
}
.jss49 {
    height: 1.1875em;
}
.jss46 {
    font: inherit;
    color: currentColor;
    width: 100%;
    border: 0;
    margin: 0;
    padding: 6px 0 7px;
    display: block;
    min-width: 0;
    box-sizing: content-box;
    background: none;
    -webkit-tap-highlight-color: transparent;
}
[type="search"] {
    appearance: textfield;
    outline-offset: -2px;
}
button, input {
    overflow: visible;
}
.d2-ui-table {
    background-color: #fff;
    border-spacing: 0;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.12),0 1px 2px 0 rgba(0,0,0,.24);
    color: #212121;
    display: table;
    margin-bottom: 2rem;
    max-width: 100%;
    width: 100%;
}
.d2-ui-table {
    margin-bottom: 0px !important;
    margin-top: 0px !important;
}
.d2-ui-table__headers {
    display: table-row;
}
.d2-ui-table__headers__header {
    height: 50px;
    padding: 0 1.6rem;
    vertical-align: middle;
    border-bottom: 2px solid #e0e0e0;
    color: #757575;
    display: table-cell;
    font-weight: 400;
    text-align: left;
    transition: all .3s ease;
}
.d2-ui-table__rows {
    display: table-row-group;
}
.data-table-fake-row.jsx-559166881 {
    position: relative;
    height: 50px;
    line-height: 50px;
    background-color: rgb(255, 255, 255);
    text-align: center;
    font-style: italic;
    color: rgb(117, 117, 117);
    box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px 0px, rgba(0, 0, 0, 0.24) 0px 1px 2px 0px;
}
div.jsx-559166881 > .d2-ui-button {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
}

.jss686 {
    overflow: hidden;
}
.jss690 {
    box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.2),0px 1px 1px 0px rgba(0,0,0,0.14),0px 2px 1px -1px rgba(0,0,0,0.12);
}
.jss688 {
    border-radius: 4px;
}
.jss687 {
    background-color: #FFFFFF;
}
.jsx-2165642276 {
    padding: 2rem 5rem 4rem;
}
section.jsx-232685539 {
    margin: 0px 0px 10px;
    padding: 0px 2px;
    overflow: hidden;
}
section.jsx-232685539 {
    margin: 0px 0px 10px;
    padding: 0px 2px;
    overflow: hidden;
}
span.jsx-3902943628 {
    display: inline-block;
    margin-right: 10px;
}
span.jsx-3902943628 {
    display: inline-block;
    margin-right: 10px;
}
h2.jsx-4079111950 {
    color: black;
    font-weight: bold;
    font-size: 1.3em;
    line-height: 2;
    margin: 0px 0px 10px;
}
.jss317 {
    margin: 0;
    border: 0;
    display: inline-flex;
    padding: 0;
    position: relative;
    min-width: 0;
    flex-direction: column;
    vertical-align: top;
}
.jsx-516171561 {
    margin: 0px;
    width: 100%;
}
div.jsx-1762692579 {
    margin-bottom: 20px;
}
.jss329 {
    transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms,transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
}
.jss326 {
    top: 0;
    left: 0;
    position: absolute;
    transform: translate(0, 24px) scale(1);
}
.jss321 {
    transform-origin: top left;
}
.jss332 {
    color: #494949;
    padding: 0;
    font-size: 1rem;
    font-family: Roboto, Helvetica, Arial, sans-serif;
    line-height: 1;
}
label + .jss340 {
    margin-top: 16px;
}
.jss339 {
    position: relative;
}
.jss352 {
    color: #000000;
    cursor: text;
    display: inline-flex;
    font-size: 1rem;
    font-family: Roboto, Helvetica, Arial, sans-serif;
    line-height: 1.1875em;
    align-items: center;
}
.jss362 {
    font: inherit;
    color: currentColor;
    width: 100%;
    border: 0;
    margin: 0;
    padding: 6px 0 7px;
    display: block;
    min-width: 0;
    box-sizing: content-box;
    background: none;
    -webkit-tap-highlight-color: transparent;
}
.jss714 {
    color: #494949;
    margin: 0;
        margin-top: 0px;
    font-size: 0.75rem;
    text-align: left;
    margin-top: 8px;
    min-height: 1em;
    font-family: Roboto, Helvetica, Arial, sans-serif;
    line-height: 1em;
}
span.jsx-1725314990 {
    color: rgb(244, 67, 54);
}
.jss751 {
    color: rgba(0, 0, 0, 0.87);
    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2),0px 2px 2px 0px rgba(0,0,0,0.14),0px 3px 1px -2px rgba(0,0,0,0.12);
    background-color: #e0e0e0;
}
.jss740 {
    color: #000000;
    padding: 6px 16px;
    font-size: 0.875rem;
    min-width: 64px;
    box-sizing: border-box;
    transition: background-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms,box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms,border 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    line-height: 1.75;
    font-family: Roboto, Helvetica, Arial, sans-serif;
    font-weight: 500;
    border-radius: 4px;
    text-transform: uppercase;
}
.jss766 {
    color: inherit;
    border: 0;
    margin: 0;
    cursor: pointer;
    display: inline-flex;
    outline: none;
    padding: 0;
    position: relative;
    align-items: center;
    user-select: none;
    border-radius: 0;
    vertical-align: middle;
    justify-content: center;
    -moz-appearance: none;
    text-decoration: none;
    background-color: transparent;
    -webkit-appearance: none;
    -webkit-tap-highlight-color: transparent;
}
.jss741 {
    width: 100%;
    display: inherit;
    align-items: inherit;
    justify-content: inherit;
}
.jss769 {
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: block;
    z-index: 0;
    position: absolute;
    overflow: hidden;
    border-radius: inherit;
    pointer-events: none;
}
.d2-ui-table__rows {
    display: table-row-group;
}
.d2-ui-table__rows__row {
    cursor: pointer;
    display: table-row;
}
.d2-ui-table__rows__row {
    font-size: 14px;
}
.d2-ui-table__rows__row__column {
    height: 50px;
    padding: 0 1.6rem;
    vertical-align: middle;
    border-bottom: 1px solid #e0e0e0;
    border-top: 0;
    display: table-cell;
    text-align: left;
    transition: all .3s ease;
    position: relative;
}
.d2-ui-table__rows__row__column {
    height: 50px;
    padding: 0 1.6rem;
    vertical-align: middle;
    border-bottom: 1px solid #e0e0e0;
    border-top: 0;
    display: table-cell;
    text-align: left;
    transition: all .3s ease;
    position: relative;
}


    
</style>
