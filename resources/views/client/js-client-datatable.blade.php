<script>
  /**
 * DataTables Basic
 */

'use strict';

let fv, offCanvasEl;
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewRecord = document.getElementById('form-add-new-record');

    setTimeout(() => {
      const newRecord = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#add-new-record');


      $("#add-new-record").find('.offcanvas-header h5').html('New Client');
      $("#form-add-new-record").find('button[type="submit"]').text('Submit');
      $("#form-add-new-record").find('button[type="submit"]').attr('id', 'btn-save');

      // To open offCanvas, to add new record
      if (newRecord) {
        
        newRecord.addEventListener('click', function () {
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
  

    $("#form-add-new-record").find('input').removeClass('blur-form-user-update');
    $("#form-add-new-record").find('select').removeClass('blur-form-user-update');



  // Delete Record
  $('.datatables-basic tbody').on('click', '.delete-record', function () {
    dt_basic.row($(this).parents('tr')).remove().draw();
  });
  
  // Edit Record
  $('.datatables-basic tbody').on('click', '.edit-client', function () {

    var _this = $(this);
    var id  = _this.attr('data-idx');
    // dt_basic.row($(this).parents('tr')).remove().draw();
    const formAddNewRecord = document.getElementById('form-add-new-record');

      setTimeout(() => {
          const editClient = document.querySelector('.create-new'),
          offCanvasElement = document.querySelector('#add-new-record');

        var form = $("#form-add-new-record");
        $("#add-new-record").find('.offcanvas-header h5').html('Update Client');
        form.find('button[type="submit"]').text('Update');
        form.find('button[type="submit"]').attr('id', 'btn-update');

        form.find('input').addClass('blur-form-user-update');
        form.find('select').addClass('blur-form-user-update');

        console.log("agregado");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url: "{{ route('clients.edit', ':id') }}".replace(':id', id), 
            type: 'put',
            data: {},
            success: function (r) {
                if (r.status == true)
                {
                  var data = r.data;
                  form.find("#id").val(data.id);
                  form.find("#first_name").val(data.first_name);
                  form.find("#mi").val(data.mi);
                  form.find("#last_name").val(data.last_name);
                  form.find("#ssn").val(data.ssn);
                  form.find("#date_birth").val(data.date_birdth);
                  form.find("#dl").val(data.dl);
                  form.find("#dl_state").val(data.dl_state); //select
                  form.find("#has_passport").val(data.has_passport); //select
                  form.find("#client_reference").val(data.client_reference);
                  form.find("#saludation_for_letter").val(data.saludation_for_letter);
                  form.find("#type_address-home").val(data.type_address);
                  form.find("#address_1").val(data.address_1);
                  form.find("#address_2").val(data.address_2);
                  form.find("#city").val(data.city);
                  form.find("#state").val(data.state);
                  form.find("#zipcode").val(data.zipcode);
                  form.find("#country").val(data.country);
                  form.find("#m_address_1").val(data.state);
                  form.find("#m_address_2").val(data.state);
                  form.find("select#form_type").val(data.form_type).change();
                  form.find("#spouse_first_name").val(data.spouse_first_name);
                  form.find("#spouse_mi").val(data.spouse_mi);
                  form.find("#spouse_last_name").val(data.spouse_last_name);
                  form.find("#spouse_ssn").val(data.spouse_ssn);
                  form.find("#spouse_date_birdth").val(data.spouse_date_birdth);
                  form.find("#spouse_dl").val(data.spouse_dl);
                  form.find("select#spouse_dl_state").val(data.spouse_dl_state).change();
                  form.find("select#spouse_has_passport").val(data.spouse_has_passport).change();
                  form.find("#spouse_saludation_for_letter").val(data.spouse_saludation_for_letter);
                  form.find("#phone_home").val(data.phone_home);
                  form.find("#cell_home").val(data.cell_home);
                  form.find("#preferred").val(data.fax_work);
                  form.find("#fax_home").val(data.fax_home);
                  form.find("#phone_work").val(data.phone_work);
                  form.find("#spouse_phone_home").val(data.spouse_phone_home);
                  form.find("#spouse_cell_home").val(data.spouse_cell_home);
                  form.find("#spouse_fax_home").val(data.spouse_fax_home);
                  form.find("#spouse_phone_work").val(data.spouse_phone_work);
                  form.find("#spouse_cell_work").val(data.spouse_cell_work);
                  form.find("#spouse_preferred").val(data.spouse_fax_work);
                  form.find("#cell_work").val(data.cell_work);
                  form.find("#tax_payer_email").val(data.tax_payer_email);
                  form.find("#spouse_email").val(data.spouse_email);
                  // form.find("#state").val(data.state);
                  // form.find("#state").val(data.state);
                  // form.find("#state").val(data.state);
                  // form.find("#state").val(data.state);
                  // form.find("#state").val(data.state);

                }
                // toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                // console.log("error");
                // toast_msg(responseJSON.message, 'error', "Aviso");
            },
        });

          // To open offCanvas, to add new record
          if (editClient) {
              offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
              offCanvasEl.show();
            // });
          }

        }, 200);

    console.log("Hola");

    
  });

  // Complex Header DataTable
  // --------------------------------------------------------------------

  

});

jQuery(document).on('click', '.create-new',function(e)
{
    $("#add-new-record").find('.offcanvas-header h5').html('New Client');
    var form = $("#form-add-new-record");
    form.find('button[type="submit"]').text('Submit');
    form.find('button[type="submit"]').attr('id', 'btn-save');

    form.find("#id").val("0");
    form.find("#first_name").val("");
    form.find("#mi").val("");
    form.find("#last_name").val("");
    form.find("#ssn").val("");
    form.find("#date_birth").val("");
    form.find("#dl").val("");
    form.find("#dl_state").val(""); //select
    form.find("#has_passport").val(""); //select
    form.find("#client_reference").val("");
    form.find("#saludation_for_letter").val("");
    form.find("#type_address-home").val("");
    form.find("#address_1").val("");
    form.find("#address_2").val("");
    form.find("#city").val("");
    form.find("#state").val("");
    form.find("#zipocode").val("");
    form.find("#country").val("");
    form.find("#m_address_1").val("");
    form.find("#m_address_2").val("");


    form.find("select#form_type").val("").change();
    form.find("#spouse_first_name").val("");
    form.find("#spouse_mi").val("");
    form.find("#spouse_last_name").val("");
    form.find("#spouse_ssn").val("");
    form.find("#spouse_date_birdth").val("");
    form.find("#spouse_dl").val("");
    form.find("select#spouse_dl_state").val("").change();
    form.find("select#spouse_has_passport").val("").change();
    form.find("#spouse_saludation_for_letter").val("");
    form.find("#phone_home").val("");
    form.find("#cell_home").val("");
    form.find("#preferred").val("");
    form.find("#fax_home").val("");
    form.find("#phone_work").val("");
    form.find("#spouse_phone_home").val("");
    form.find("#spouse_cell_home").val("");
    form.find("#spouse_fax_home").val("");
    form.find("#spouse_phone_work").val("");
    form.find("#spouse_cell_work").val("");
    form.find("#spouse_preferred").val("");
    form.find("#cell_work").val("");
    form.find("#tax_payer_email").val("");
    form.find("#spouse_email").val("");


})
//
jQuery(document).on('click', '#form-add-new-record #btn-save',function(e)
{
      
      var _thisButton = $(this);

      _thisButton.html('Prosesing...');
      _thisButton.attr('disabled','disabled');

      var form = 'form-add-new-record'; //$(this).attr('data-form');
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('clients.save')}}",
            type: 'post',
            data: $("#"+form).serialize(),
            success: function (r) {
                _thisButton.html('Submit');
                _thisButton.removeAttr('disabled');
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  initializeDatatable();

                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                toast_msg(responseJSON.message, 'error', "Aviso");
                _thisButton.html('Submit');
                _thisButton.removeAttr('disabled');
            },
        });
})


jQuery(document).on('click', '#form-add-new-record #btn-update',function(e)
{
      var _thisButton = $(this);
          _thisButton.html('Prosesing...');
          _thisButton.attr('disabled','disabled');


      var form  = 'form-add-new-record'; //$(this).attr('data-form');
      var id    = $("#"+form).find("#id").val();
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('clients.update', ':id') }}".replace(':id', id), 
            type: 'put',
            data: $("#"+form).serialize(),
            success: function (r) {

                _thisButton.html('Update');
                _thisButton.removeAttr('disabled');
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  initializeDatatable();

                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                toast_msg(responseJSON.message, 'error', "Aviso");

                _thisButton.html('Update');
                _thisButton.removeAttr('disabled');
            },
        });
})






jQuery(document).on('click', '.btn-asigment',function(e)
{
  var _this   = $(this);

  if (!_this.hasClass('disabled'))
  {
    var user    = _this.attr('data-user');
    var client  = _this.attr('data-client');

      $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{route('clients.asigment_to_user')}}",
              type: 'post',
              // data: {user:user, client:client, _token : $("#_token").val()},
              data: $("#frmAsignClientToUser").serialize(),
              success: function (r) {
                  if (r.status)
                  {
                    var htmlx = _this.html('<i class="ri-user-3-line ri-22px"></i>');
                                _this.removeClass('btn-outline-primary');
                                _this.addClass('btn-primary');
                                _this.addClass('disabled');
                  }
                  toast_msg(r.msg, r.type, r.title);

              },
              error: function (error) {
                  console.log("error");
              },
          });
  }

})


function initializeDatatable()
{
  console.log("init table");
  const tableSelector = '#table-list-client';

  



  var dt_basic_table = $('.datatables-basic'),
    dt_complex_header_table = $('.dt-complex-header'),
    dt_row_grouping_table = $('.dt-row-grouping'),
    dt_multilingual_table = $('.dt-multilingual'),
    dt_basic;

  var dt_basic_table_id = $(tableSelector);

    if ($.fn.dataTable.isDataTable('.datatables-basic') ) {
      $('.datatables-basic').dataTable().fnDestroy();
    }

    if ( $.fn.DataTable.isDataTable(tableSelector) ) {
      $(tableSelector).DataTable().clear().destroy();
    }
  // DataTable with buttons
  // --------------------------------------------------------------------

  console.log("destroy");
  if (dt_basic_table_id.length) {
    dt_basic = dt_basic_table_id.DataTable({
      // ajax: assetsPath + 'json/table-datatable.json',
      ajax: "{{route('clients.clients_json')}}",
      columns: [
        { data: 'DT_RowIndex' },
        { data: 'company_name' },
        { data: 'full_name' },
        { data: 'tax_payer_email' },
        { data: 'services_offered' },
        { data: 'city' },
        { data: 'phone' },
        { data: 'form_type' },
        { data: 'asign_to' },
        { data: 'status' },
        { data: 'case_status' },
        // { data: 'actions' }
      ],
      columnDefs: [],
      order: [[0, 'asc']],
      dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
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
              extend: 'print',
              text: '<i class="ri-printer-line me-1" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [3, 4, 5, 6, 7],
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
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', config.colors.headingColor)
                  .css('border-color', config.colors.borderColor)
                  .css('background-color', config.colors.bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ri-file-text-line me-1" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [3, 4, 5, 6, 7],
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
              extend: 'excel',
              text: '<i class="ri-file-excel-line me-1"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [3, 4, 5, 6, 7],
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
                columns: [3, 4, 5, 6, 7],
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
              extend: 'copy',
              text: '<i class="ri-file-copy-line me-1" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [3, 4, 5, 6, 7],
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
          text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Add New Client</span>',
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
    $('div.head-label').html('<h5 class="card-title mb-0">Clients</h5>');
  }
}

jQuery(document).on('click', '.detail-href',function(e)
{
  var id    = $(this).attr('data-idx');
  var url   = "{{route('clients.detail', ['id' => ':id']) }}";
      url   = url.replace(':id', id);
      // console.log(url);
      // window.location = url;
})
jQuery(document).on('click', '.profile-item-user',function(e)
{
      var id = $(this).attr('data-idx');

      $(".btn-asigment").attr('data-client', id);
      $("#frm-add-activity").find("#client_id").val(id);
      $("#frm-add-notes").find("#client_id").val(id);
      $("#my-dropzone").find("#client_id").val(id);
      profileClient(id);
          
})

jQuery(document).on('click', '.change-form-type',function(e)
{
  var _this = $(this);
  var client_id = _this.attr('data-idx'); 
  var _value    = _this.attr('data-type'); 

  var id = $("#client_idx").val();
    $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{route('clients.update_info_question', ':id')}}".replace(':id', client_id), 
          type: 'put',
          data: {name:'form_type', value : _value},
          success: function (r) {
            toast_msg(r.msg, r.type, r.title);
            initializeDatatable();
          },
          error: function (error) {
              // console.log(error.responseJSON.message);
              toast_msg(error.responseJSON.message, "error", "Warning");
          },
      });
})

jQuery(document).on('click', '.change-case-status',function(e)
{
  var _this = $(this);
  var client_id = _this.attr('data-idx'); 
  var _value    = _this.attr('data-case'); 

  var id = $("#client_idx").val();
    $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{route('clients.update_info_question', ':id')}}".replace(':id', client_id), 
          type: 'put',
          data: {name:'case_status', value : _value},
          success: function (r) {
            toast_msg(r.msg, r.type, r.title);
            initializeDatatable();
          },
          error: function (error) {
              // console.log(error.responseJSON.message);
              toast_msg(error.responseJSON.message, "error", "Warning");
          },
      });
})




jQuery(document).on('click', '.is_married',function(e)
{ 
  var _this   = $(this);
  var value   = _this.val();
  var content = $(".info-content-married");

  //1 = married; 2=unmarried
  if (value == 1)
  {
    content.removeClass('d-none').hide()
      .stop(true, true)
      .slideDown(300);
  } else 
  {
    content.stop(true, true)
      .slideUp(300, function() {
        $(this).addClass('d-none');
        });
  }

})

jQuery(document).on('click', '.show-user-asign-client',function(e)
{
  
    var id = $(this).attr('data-client');
      
    $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{route('clients.info_asign', ':id')}}".replace(':id', id), 
          type: 'get',
          success: function (r) {
            if (r.status == false)
            {

            }else
            {
                  $.each(r.list, function( index, value )
                  {
              //
                      // console.log(value.id);
                      $('#frmAsignClientToUser tbody tr').each(function(index, tr) {

                        let input       = $(tr).find('.user-list');
                        let valor_user  = input.val();
                        console.log("value desde ajax: "+value.user_id+"     input tabla: "+valor_user);
                            if (value.user_id == valor_user)
                            {
                              $(input).prop('checked', true);
                            }
                    });
                  })
              
            }
          },
          error: function (error) {
              // console.log(error.responseJSON.message);
              // toast_msg(error.responseJSON.message, "error", "Warning");
          },
      });


})
</script>