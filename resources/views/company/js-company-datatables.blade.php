<script>
	/**
 * DataTables Basic
 */

'use strict';

let fv, offCanvasEl;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewUser = document.getElementById('form-add-company');

    setTimeout(() => {
      const newUser = document.querySelector('.btn-modal-new'),
        offCanvasElement = document.querySelector('#add-company');

      // To open offCanvas, to add new record
      if (newUser) {
        newUser.addEventListener('click', function () {
          offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
          // Empty fields on offCanvas open
            // (offCanvasElement.querySelector('.dt-full-name').value = ''),
            // (offCanvasElement.querySelector('.dt-post').value = ''),
            // (offCanvasElement.querySelector('.dt-email').value = ''),
            // (offCanvasElement.querySelector('.dt-date').value = '');
            // (offCanvasElement.querySelector('.dt-salary').value = '');
          // Open offCanvas with form
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
  
  $('.datatables-basic tbody').on('click', '.suspend-company', function (e)
  {

        var id = $(this).attr('data-id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert company!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, Suspend company!',
          customClass: {
            confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
            cancelButton: 'btn btn-outline-secondary waves-effect'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {

                    $.ajax({
                      url: "{{route('company.destroy')}}",
                      type: 'post',
                      data:{
                        id:id,
                        _token: "{{ csrf_token() }}",
                      },
                      success: function (r) {
                          if (r.status == true)
                          {
                            initializeDatatable();

                          }
                          toast_msg(r.msg, r.type, r.title);

                          Swal.fire({
                            icon: 'success',
                            title: 'Suspended!',
                            text: 'Company has been suspended.',
                            customClass: {
                              confirmButton: 'btn btn-success waves-effect'
                            }
                          });

                      },
                      error: function (error) {
                          console.log("error");
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
  })
  // Edit Record
  $('.datatables-basic tbody').on('click', '.btn-edit', function () {
    
      var id = $(this).attr('data-id');
      var form = $(this).attr('data-form');
      console.log(form);


      $.ajax({
              url: "{{route('company.edit')}}",
              type: 'post',
              data:{
                id:id,
                _token: "{{ csrf_token() }}",
              },
              success: function (r) {
                  if (r.status == true)
                  {
                    var info = r.data;
                    $("#"+form).find("#_id").val(info.id);
                    $("#"+form).find("#name").val(info.name);
                    $("#"+form).find("#state option:selected").removeAttr('selected');
                    $("#"+form).find("#state option[value="+info.state_id+"]").attr("selected",true);
                    $("#"+form).find("#city").val(info.city);
                    $("#"+form).find("#address_1").val(info.address_1);
                    $("#"+form).find("#address_2").val(info.address_2);
                    $("#"+form).find("#office_phone").val(info.office_phone);
                    $("#"+form).find("#office_cell").val(info.office_cell);
                    $("#"+form).find("#status option:selected").removeAttr('selected');
                    $("#"+form).find("#status option[value="+info.status+"]").attr("selected",true);
                  }

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

          if (dt_basic_table.length) {
            dt_basic = dt_basic_table.DataTable({
              ajax: '{{route('company.company_json')}}',
              //id | NAME | state_id | city | address_1 | phone | created_at | actions
              columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'state_name' },
                { data: 'city' },
                { data: 'address_1' },
                { data: 'office_phone' },
                { data: 'created_at'},
                { data: 'status'},
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
              order: [[2, 'desc']],
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
                  text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Add New Company</span>',
                  className: 'btn-modal-new btn btn-primary waves-effect waves-light ',
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
            $('div.head-label').html('<h5 class="card-title mb-0">Company</h5>');
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

jQuery(document).on('click', '#form-add-company #btn-save',function(e)
{
      var form = $(this).attr('data-form');
     
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/company/save',
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
                setTimeout(
                  function() 
                  {
                    window.location.href = "{{route('company.index')}}";
                  }, 2500);

            },
            error: function (error) {
                var responseJSON = error.responseJSON;
                // console.log(error);
                toast_msg(responseJSON.msg, 'error', 'Warning');
            },
        });
      
})


jQuery(document).on('click', '#form-edit-company #btn-save',function(e)
{
      var form = $(this).attr('data-form');
      
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('company.update')}}",
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
      
})

</script>