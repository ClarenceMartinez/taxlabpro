<script>
	/**
 * DataTables Basic
 */

'use strict';

let fv, offCanvasEl;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewUser = document.getElementById('form-add-new-user');

    setTimeout(() => {
      const newUser = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#add-new-user');

      // To open offCanvas, to add new record
      if (newUser) {
        newUser.addEventListener('click', function () {
          offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
          offCanvasEl.show();
        });
      }
    }, 200);

  })();
});

// datatable (jquery)
$(function () {
  initializeDatatable();

  // Delete Record
  $('.datatables-basic tbody').on('click', '.delete-user', function () {
    // dt_basic.row($(this).parents('tr')).remove().draw();

    	var id = $(this).attr('data-id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert User!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, Suspend User!',
          customClass: {
            confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
            cancelButton: 'btn btn-outline-secondary waves-effect'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {

                    $.ajax({
                      url: "{{route('users.destroy')}}",
                      type: 'post',
                      data:{
                        id:id,
                        _token: "{{ csrf_token() }}",
                      },
                      success: function (r) {
                          if (r.status == true)
                          {
                            initializeDatatable();
                            Swal.fire({
                              icon: 'success',
                              title: 'Suspended!',
                              text: 'User has been suspended.',
                              customClass: {
                                confirmButton: 'btn btn-success waves-effect'
                              }
                            });

                          }
                          toast_msg(r.msg, r.type, r.title);


                      },
                      error: function (error) {
                          var responseJSON = error.responseJSON;
                          toast_msg(responseJSON.msg, 'warning', 'Warning');
                      },
                  });

          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Cancelled Suspension :)',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success waves-effect'
              }
            });
          }
        });






  });
  
  // Delete Record
  $('.datatables-basic tbody').on('click', '.btn-edit', function () {
    

      var id = $(this).attr('data-id');
      var form = $(this).attr('data-form');

      $.ajax({
              url: "{{route('users.edit')}}",
              type: 'post',
              data:{
                id:id,
                _token :$("#_token").val()
              },
              success: function (r) {
                  var $f = $('#'+form);
                  $f[0].reset();
                  if (r.status == true)
                  {
                    var info = r.data;
                    var $f = $('#'+form);
                    $f.find("#_id").val(info.id);
                    $f.find("#name").val(info.name);
                    $f.find("#email").val(info.email);

                    $f.find("#company_id option:selected").removeAttr('selected');
                    $f.find("#company_id option[value="+info.company_id+"]").attr("selected",true);
                    $f.find("#type option:selected").removeAttr('selected');
                    $f.find("#type option[value="+info.type+"]").attr("selected",true);
                    $f.find("#status option:selected").removeAttr('selected');
                    $f.find("#status option[value="+info.status+"]").attr("selected",true);

                    // $("#"+form).find("#email").val(info.email);



                    $f.find('#timezone').val(info.timezone);

                    // Email signature
                    $f.find('#email_signature').val(info.email_signature);

                    $f.find('#firm_ein').val(info.firm_ein);
                    $f.find('#caf_no').val(info.caf_no);
                    $f.find('#ptin').val(info.ptin);
                    $f.find('#ctec').val(info.ctec);
                    $f.find('#ny_tprin').val(info.ny_tprin);
                    // $f.find('#designation').val(info.designation);
                    $f.find('#licensing_jurisdiction').val(info.licensing_jurisdiction);
                    $f.find('#license_no').val(info.license_no);
                    $f.find('#a2a').val(info.a2a);


                    $f.find("#designation option:selected").removeAttr('selected');
                    $f.find("#designation option[value="+info.designation+"]").attr("selected",true);

                    // Power of Attorney Defaults for Individuals (3 filas)
                    // for (var i = 1; i <= 3; i++) {
                    //   $f.find('[name="poa'+i+'_description"]')
                    //     .val(info['poa'+i+'_description']);
                    //   $f.find('[name="poa'+i+'_form_number"]')
                    //     .val(info['poa'+i+'_form_number']);
                    //   $f.find('[name="poa'+i+'_period"]')
                    //     .val(info['poa'+i+'_period']);
                    // }







                    var defaultDescriptions1 = ['', 'Income, SRP','Separate Assessments','Civil Penalties'];
                    var defaultForms1        = ['', '1040','1040','N/A'];
                    var defaultPeriod1       = ['', '2010 - {$year + 3}','2010 - {$year + 3}','2010 - {$year + 3}'];

                    for (let j = 1; j <= 3; j++) {
                        const keyPrefix = 'poa' + j + '_';

                        let description = info[keyPrefix + 'description'];
                        if (!description || description === '') {
                            description = defaultDescriptions1[j];
                        }

                        let form_number = info[keyPrefix + 'form_number'];
                        if (!form_number || form_number === '') {
                            form_number = defaultForms1[j];
                        }

                        let period = info[keyPrefix + 'period'];
                        if (!period || period === '') {
                            period = defaultPeriod1[j];
                        }

                        $f.find(`[name="${keyPrefix}description"]`).val(description);
                        $f.find(`[name="${keyPrefix}form_number"]`).val(form_number);
                        $f.find(`[name="${keyPrefix}period"]`).val(period);
                    }
                   













                    var defaultDescriptions = ['', 'Income','Payroll','Civil Penalties,Section 4980H'];
                    var defaultForms        = ['', '1120, 1120S, 1065,1041','940, 941, 943, 944','N/A'];
                    var defaultPeriod       = ['', '2010 - {$year + 3}','2010 - {$year + 3}','2010 - {$year + 3}'];

                    for (let j = 1; j <= 3; j++) {
                        const keyPrefix = 'poa_bus' + j + '_';

                        let description = info[keyPrefix + 'description'];
                        if (!description || description === '') {
                            description = defaultDescriptions[j];
                        }

                        let form_number = info[keyPrefix + 'form_number'];
                        if (!form_number || form_number === '') {
                            form_number = defaultForms[j];
                        }

                        let period = info[keyPrefix + 'period'];
                        if (!period || period === '') {
                            period = defaultPeriod[j];
                        }

                        $f.find(`[name="${keyPrefix}description"]`).val(description);
                        $f.find(`[name="${keyPrefix}form_number"]`).val(form_number);
                        $f.find(`[name="${keyPrefix}period"]`).val(period);
                    }

                    $f.find("#firm_ein").val(info.firm_ein);
                    $f.find("#caf_no").val(info.caf_no);
                    $f.find("#ptin").val(info.ptin);
                    $f.find("#ctec").val(info.ctec);
                    $f.find("#ny_tprin").val(info.ny_tprin);
                    // $f.find("#designation").val(info.designation);

                    $f.find("#designation option").prop("selected", false);

                    // Usa comillas simples dentro del selector para envolver el valor
                    $f.find("#designation option[value='" + info.designation + "']")
                      .prop("selected", true);
                    
                    $f.find("#licensing_jurisdiction").val(info.licensing_jurisdiction);
                    $f.find("#license_no").val(info.license_no);
                    $f.find("#a2a").val(info.a2a);


                  } 
                  else
                  {
                    toast_msg(r.msg, 'error', 'Warning');
                    $(".btn-close").click();
                  }
                  //aqui necesito resetear el formulario
                  


              },
              error: function (error) {
                  console.log("error");
              },
          });

  });

  // Complex Header DataTable
  // --------------------------------------------------------------------

  

});



function initializeDatatable()
  {

          let dt_basic_table = $('.datatables-basic'), dt_basic;
          if ($.fn.dataTable.isDataTable('.datatables-basic') ) {
            $('.datatables-basic').dataTable().fnDestroy();
          }
          // DataTable with buttons
          // --------------------------------------------------------------------
          var company_reference_id = $('#company_reference_id').val();

          if (dt_basic_table.length) {
            dt_basic = dt_basic_table.DataTable({
              // ajax: "{{route('users.users_json')}}",
              // ajax: "{{ route('users.users_json_by_company') }}",
              ajax: "/users/users-json-by-company?company_id=" + company_reference_id,

              columns: [
                // { data: 'id' },
                { data: 'DT_RowIndex' },
                { data: 'name' },
                { data: 'company_name' },
                { data: 'email' },
                { data: 'type' },
                { data: 'created_at'},
                { data: 'status' },
                { data: 'actions' }
              ],
              columnDefs: [
                // {
                //   // For Responsive
                //   className: 'control',
                //   targets: 0,
                //   // visible: false,
                //   orderable: false,
                //   searchable: false,
                //   responsivePriority: 2,
                //   render: function (data, type, full, meta) {
                //     return '';
                //   }
                // },
                // {
                //   // For Checkboxes
                //   targets: 1,
                //   // visible: false,
                //   orderable: false,
                //   searchable: false,
                //   responsivePriority: 3,
                //   checkboxes: true,
                //   render: function () {
                //     return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                //   },
                //   checkboxes: {
                //     selectAllRender: '<input type="checkbox" class="form-check-input">'
                //   }
                // },
                // {
                //   // Avatar image/badge, Name and post
                //   targets: 3,
                //   responsivePriority: 4,
                //   render: function (data, type, full, meta) {
                //     var $user_img = full['avatar'],
                //       $name = full['name'];
                //     if ($user_img) {
                //       // For Avatar image
                //       var $output = '';
                //         // '<img src="' + assetsPath + 'img/avatars/' + $user_img + '" alt="Avatar" class="rounded-circle">';
                //     } else {
                //       // For Avatar badge
                //       var stateNum = Math.floor(Math.random() * 6);
                //       var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                //       var $state = states[stateNum],
                //         $name = full['name'],
                //         $initials = $name.match(/\b\w/g) || [];
                //       $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                //       $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                //     }
                //     // Creates full output for row
                //     var $row_output =
                //       '<div class="d-flex justify-content-start align-items-center user-name">' +
                //       '<div class="avatar-wrapper">' +
                //       '<div class="avatar me-2">' +
                //       $output +
                //       '</div>' +
                //       '</div>' +
                //       '<div class="d-flex flex-column">' +
                //       '<span class="emp_name text-truncate text-heading fw-medium">' +
                //       $name +
                //       '</span>' +
                      
                //       '</div>' +
                //       '</div>';
                //     return $row_output;
                //   }
                // },
                // {
                //   // responsivePriority: 1,
                //   targets: 4
                // },
                
                // {
                //   targets: -2,
                //   render: function (data, type, full, meta) {
                //     var $status_number = full['status'];
                //     var $status = {
                //       1: { title: 'Active', class: 'bg-label-success' },
                //       2: { title: 'Cosed', class: ' bg-label-primary' },
                //       3: { title: 'Pending', class: ' bg-label-warning' },
                //     };
                //     if (typeof $status[$status_number] === 'undefined') {
                //       return data;
                //     }
                //     return (
                //       '<span class="badge rounded-pill ' +
                //       $status[$status_number].class +
                //       '">' +
                //       $status[$status_number].title +
                //       '</span>'
                //     );
                //   }
                // }
                // ,
                // {
                //   // Actions
                //   targets: -1,
                //   title: 'Actions',
                //   orderable: false,
                //   searchable: false,
                //   render: function (data, type, full, meta) {
                //     // console.log(full);
                //     return (
                //       '<div class="d-inline-block">' +
                //       '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></a>' +
                //       '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                //       '<li><a href="users/profile/'+full.id+'" class="dropdown-item" >Profile</a></li>' +
                //       '</ul>' +
                //       '</div>' +
                //       '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit edit-user" data-form="form-update-user" data-id="'+full.id+'"><i class="ri-edit-box-line"></i></a>'+
                //       '<a href="javascript:;" class="btn btn-sm btn-text-danger rounded-pill btn-icon item-delete delete-user" data-id="'+full.id+'"><i class="ri-close-line"></i></a>'
                //     );
                //   }
                // }
              ],
              order: [[0, 'asc']],
              dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
              displayLength: 10,
              lengthMenu: [10, 25, 50, 75, 100],
              language: {
                paginate: {
                  next: '<i class="ri-arrow-right-s-line"></i>',
                  previous: '<i class="ri-arrow-left-s-line"></i>'
                }
              },
              buttons: [
                {
                  extend: 'collection',
                  className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                  text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                  buttons: [
                    {
                      extend: 'excel',
                      text: '<i class="ri-file-excel-line me-1"></i>Excel',
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                              if (item.classList !== undefined && item.classList.contains('user-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                              } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                              } else result = result + item.innerText;
                            });
                            return result;
                          }
                        }
                      }
                    },
                    {
                      extend: 'pdf',
                      text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                              if (item.classList !== undefined && item.classList.contains('user-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                              } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                              } else result = result + item.innerText;
                            });
                            return result;
                          }
                        }
                      }
                    }
                    
                  ]
                },
                {
                  text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Add New User</span>',
                  className: 'create-new btn btn-primary waves-effect waves-light'
                }
              ],
              responsive: {
                details: {
                  display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                      var data = row.data();
                      return 'Details of ' + data['full_name'];
                    }
                  }),
                  type: 'column',
                  renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, function (col, i) {
                      return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                        ? '<tr data-dt-row="' +
                            col.rowIndex +
                            '" data-dt-column="' +
                            col.columnIndex +
                            '">' +
                            '<td>' +
                            col.title +
                            ':' +
                            '</td> ' +
                            '<td>' +
                            col.data +
                            '</td>' +
                            '</tr>'
                        : '';
                    }).join('');

                    return data ? $('<table class="table"/><tbody />').append(data) : false;
                  }
                }
              }
            });
            $('div.head-label').html('<h5 class="card-title mb-0">Users</h5>');
          }
  }
function validationFomEmail(form)
{
  
  var email = $("#"+form).find('#email').val();
  var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
  var div = '#xmail';
    if (caract.test(email) == false){
        $(div).hide().removeClass('d-none').slideDown('fast');

        return false;
    }else{
        $(div).hide().addClass('d-none').slideDown('slow');
//        $(div).html('');
        return true;
    }

}

jQuery(document).on('click', '#form-add-new-user #btn-save',function(e)
{
      var form = $(this).attr('data-form');
      if (validationFomEmail(form))
      { 
          $.ajax({
            url: '/users/save',
            type: 'post',
            data: $("#"+form).serialize(),
            success: function (r) {
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  initializeDatatable();

                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
                // console.log("error");
                var responseJSON = error.responseJSON;
                // console.log(responseJSON.message);
                toast_msg(responseJSON.message, 'error', 'Warning');
            },
        });
      }
})


jQuery(document).on('click', '#form-update-user #btn-save',function(e)
{
      var form = $(this).attr('data-form');
      if (validationFomEmail(form))
      { 
          $.ajax({
            url: '/users/update',
            type: 'post',
            data: $("#"+form).serialize(),
            success: function (r) {
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  initializeDatatable();

                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
                console.log("error");
            },
        });
      }
})
</script>