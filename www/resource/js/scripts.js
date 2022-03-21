document.write("<script src='//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js' ><" + '/script>')

/***********************************
 js 공용 null 체크함수
 ***********************************/

var isEmpty = function (value) {
  if (value == '' || value == null || value == undefined || (value != null && typeof value == 'object' && !Object.keys(value).length)) {
    return true
  } else {
    return false
  }
}

/***********************************/

function checkCapsLock(event) {
  if (event.getModifierState('CapsLock')) {
    // alert("Caps-Lock is on");

    $('#check_caps_lock').css('display', 'block')
    setTimeout(function () {
      $('#check_caps_lock').css('display', 'none')
    }, 3000)
  } else {
    $('#check_caps_lock').css('display', 'none')
  }
}

function checkCapsLock1(event) {
  if (event.getModifierState('CapsLock')) {
    // alert("Caps-Lock is on");

    $('#check_caps_lock1').css('display', 'block')
    setTimeout(function () {
      $('#check_caps_lock1').css('display', 'none')
    }, 3000)
  } else {
    $('#check_caps_lock1').css('display', 'none')
  }
}

function checkCapsLock2(event) {
  if (event.getModifierState('CapsLock')) {
    // alert("Caps-Lock is on");

    $('#check_caps_lock2').css('display', 'block')
    setTimeout(function () {
      $('#check_caps_lock2').css('display', 'none')
    }, 3000)
  } else {
    $('#check_caps_lock2').css('display', 'none')
  }
}

function checkLoginInfoNull() {
  var captcha = document.getElementById('captcha') ? true : false

  if (member_info_form.user_id.value == '') {
    $('#check_id').css('display', '')
    $('#check_pass').css('display', 'none')
    $('#login_failed').css('display', 'none')
    $('#user_id').focus()
    return false
  }

  if (member_info_form.user_pass.value == '') {
    $('#check_pass').css('display', '')
    $('#check_id').css('display', 'none')
    $('#login_failed').css('display', 'none')
    $('#user_pass').focus()
    return false
  }

  if (captcha) {
    if (member_info_form.captcha_result.value == '') {
      $('#ch_result_null').css('display', '')
      $('#check_pass').css('display', 'none')
      $('#captcha_result').focus()
      return false
    }
  }
}

function daumPostcode() {
  new daum.Postcode({
    oncomplete: function (data) {
      var addr = '' // 주소 변수
      var extraAddr = '' // 참고항목 변수

      //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
      if (data.userSelectedType === 'R') {
        // 사용자가 도로명 주소를 선택했을 경우
        addr = data.roadAddress
      } else {
        // 사용자가 지번 주소를 선택했을 경우(J)
        addr = data.jibunAddress
      }

      // 우편번호와 주소 정보를 해당 필드에 넣는다.
      document.getElementById('postcode').value = data.zonecode
      document.getElementById('roadAddress').value = addr
      // document.getElementById("jibunAddress").value = data.jibunAddress;
      document.getElementById('detailAddress').focus()
      // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
      if (addr !== '') {
        //document.getElementById("extraAddress").value = extraRoadAddr;
      } else {
        // document.getElementById("extraAddress").value = '';
      }

      var guideTextBox = document.getElementById('guide')
      // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
      if (data.autoRoadAddress) {
        var expRoadAddr = data.autoRoadAddress + extraRoadAddr
        guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')'
        guideTextBox.style.display = 'block'
      } else if (data.autoJibunAddress) {
        var expJibunAddr = data.autoJibunAddress
        guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')'
        guideTextBox.style.display = 'block'
      } else {
        guideTextBox.innerHTML = ''
        guideTextBox.style.display = 'none'
      }
    },
  }).open()
}

function radioCaptcha() {
  var audio = new Audio('../../views/captcha.wav')
  audio.play()

  $('#img_captcha').css('display', 'none')
  $('#radio_captcha').css('display', '')

  $('#btn_radio').css('display', 'none')
  $('#btn_img').css('display', '')

  $('#radio_key').prop('disabled', false)
  $('#image_key').prop('disabled', true)
}

function imageCaptcha() {
  $('#img_captcha').css('display', '')
  $('#radio_captcha').css('display', 'none')

  $('#btn_radio').css('display', '')
  $('#btn_img').css('display', 'none')

  $('#radio_key').prop('disabled', true)
  $('#image_key').prop('disabled', false)
}

function selectPhone() {
  $('#phone_div').css('display', '')
  $('#email_div').css('display', 'none')
  $('#btn_next').css('display', 'none')
}

function selectEmail() {
  $('#email_div').css('display', '')
  $('#phone_div').css('display', 'none')
  $('#btn_next').css('display', 'block')
}

function selectSignupEmail() {
  if ($('#selectEmail').val() == '1') {
    $('#email_domain').prop('readonly', false)
    $('#email_domain').val('')
  } else {
    $('#email_domain').prop('readonly', true)
    $('#email_domain').val($('#selectEmail').val())
  }
}

function verification() {
  if ($('#vcode').val() == '') {
    alert('Please enter the code!')
    $('#vcode').focus()
    return false
  }

  $.ajax({
    url: '../viewmodels/emailCheck.php',
    type: 'POST',
    data: {
      code: $('#vcode').val(),
    },
    dataType: 'html',
    success: function (data) {
      if (data == 'true') {
        location.href = 'signup.php'
      } else {
        alert('Please enter the verification code correctly.')
      }
    },
  })
}

function EmailVerication(type, code) {
  $.ajax({
    url: '../viewmodels/verification.php',
    type: 'POST',
    data: {
      code: code,
      email: $('#user_mail').val(),
      token: $('#user_mail').val(),
      type: type,
    },
    dataType: 'html',
    success: function (data) {
      if (data == 'Y') {
        //alert("SUC");
        document.id_form.submit()
        //location.href = "signup.php";
      } else {
        EmailVerication('S', 000000)
      }
    },
  })
}

function checkEmail() {
  if ($('#user_mail').val() == '') {
    alert('Please enter Email.')
    $('#user_mail').focus()
    return false
  } else {
    $.ajax({
      url: '../viewmodels/checkUserId.php',
      type: 'POST',
      data: {
        find_user_id: $('#user_mail').val(),
      },
      dataType: 'html',
      success: function (data) {
        //alert(data);
        if (data == 'true') {
          alert('This email already exists.')
          return false
        } else {
          if (!window.confirm('Send verification code to ' + $('#user_mail').val() + '?')) {
            return false
          }

          alert('An authentication email has been sent.')

          $('#email_check').css('display', 'none')
          $('#email_verification').css('display', 'inline-block')

          $('#mail').val($('#user_mail').val())
          $('#user').val($('#user_mail').val())
          $('#user_mail').prop('disabled', true)

          $('#user_mail_span').text($('#user_mail').val())

          $('#vcode').css('display', 'inline-block')
          $('#btn_code_check').css('display', 'inline-block')
          $('#p_vcode').css('display', 'inline-block')
          $('#email_verification').css('display', 'block')
          $('#email_check').css('display', 'none')

          $('#btn_send').css('display', 'none')

          var code = rand(100000, 999999)
          $.ajax({
            url: '../models/phpMailerAPI/phpMail.php',
            type: 'POST',
            data: {
              user_mail: $('#user_mail').val(),
              code: code,
            },
            dataType: 'html',
            success: function (data) {
              //EmailVerication("F", code);
              if (data == 1) {
              } else {
                return false
              }
            },
          })
        }
      }, //success
    })
  }
}

function rand(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min
}

function checkFindNull() {
  if ($('#phone_verification').is(':checked')) {
    alert('휴대전화 인증을 진행해주세요.')
    return false
  } else if ($('#email_verification').is(':checked')) {
    if ($('#find_name').val() == '') {
      alert('이름을 입력해 주세요.')
      $('#find_name').focus()
      return false
    } else if ($('#find_email').val() == '') {
      alert('이메일 주소를 정확하게 입력해 주세요.')
      $('#find_email').focus()
      return false
    } else if ($('#number_verification').val() == '') {
      alert('인증번호를 입력해 주세요.')
      $('#number_verification').focus()
      return false
    }

    var pass1 = $('#email_code').val()
    var pass2 = $('#number_verification').val()
    if (pass1 == pass2) {
      alert('인증에 성공했습니다.')
      email_veri_form.submit()
    } else {
      alert('인증번호를 확인해 주세요.')
      return false
    }
  }
}

function findPw() {
  if ($('#member_id').val() == '') {
    alert('Please enter Email.')
    $('#member_id').focus()
    return false
  }

  $.ajax({
    url: '../viewmodels/checkUserId.php',
    type: 'POST',
    data: {
      find_user_id: $('#member_id').val(),
    },
    dataType: 'html',
    success: function (data) {
      //alert(data);
      if (data == 'true') {
        if (!window.confirm('Send verification code to ' + $('#member_id').val() + '?')) {
          return false
        }

        alert('An authentication email has been sent.')

        var code = rand(100000, 999999)
        $.ajax({
          url: '../models/phpMailerAPI/phpMail.php',
          type: 'POST',
          data: {
            user_mail: $('#member_id').val(),
            code: code,
            type: 'find',
          },
          dataType: 'html',
          success: function (data) {
            //  alert(data);
            document.find_pw_form_mail.submit()
          },
        })
      } else {
        document.falied_form.submit()

        // alert("This email already exists.");
        return false
      }
    },
  })
}

function pw_change() {
  if ($('#member_pass').val() == '') {
    alert('Please enter password.')
    $('#member_pass').focus()
    return false
  } else if ($('#pw_chk_value').val() == '') {
    alert("It's a wrong password.")
    $('#member_pass').focus()
    return false
  } else if ($('#member_pass_ch').val() == '') {
    alert('Please enter re-enter password.')
    $('#member_pass_ch').focus()
    return false
  } else if ($('#pw_chk_').val() == 'false') {
    alert('password do not matched.')
    $('#member_pass_ch').focus()
    return false
  } else if ($('#captcha_result').val() == '') {
    alert('Please enter an auto-input prevention character.')
    $('#captcha_result').focus()
    return false
  }

  //pw_ch_form.submit();
  $.ajax({
    url: '../viewmodels/checkCaptchResult.php',
    type: 'POST',
    data: {
      captcha_result: $('#captcha_result').val(),
      image_key: $('#image_key').val(),
    },
    dataType: 'html',
    success: function (data) {
      //alert(data);
      if (data == 'true') {
        pw_ch_form.submit()
      } else if (data == 'false') {
        alert('Please enter an auto-input prevention character.')
        $('#login_captcha').load('../viewmodels/naverCaptcha.php')
        return false
      }
    },
  })
}

/***********************************
 KMC 인증 URL 코드 바인딩
 ***********************************/

function kmcis(tr_url) {
  var thisUrl = window.location.href
  var url_code

  if (thisUrl.indexOf('findMemberId.php') != -1) {
    url_code = '007003'
  } else if (thisUrl.indexOf('findMemberPassword.php') != -1) {
    url_code = '007002'
  } else if (thisUrl.indexOf('identification.php') != -1) {
    url_code = '007001'
  } else {
    alert('false')
    return false
  }

  $.ajax({
    url: '../models/kmcSend.php',
    type: 'POST',
    data: {
      urlCode: url_code,
    },
    dataType: 'html',
    success: function (data) {
      openKMCISWindow(data, tr_url)
    },
  })
}

/***********************************
 service 팝업
 ***********************************/
function servicePopup() {
  $.ajax({
    cache: false,
    url: './service/service_info_delete.php',
    type: 'POST',
    data: {},
    dataType: 'html',
    success: function (data) {
      if (data == 'true') {
        // @LUCAS 팝업이 아닌 서비스 페이지로 변경.
        location.href = './service/01_treatment_option1.php'
      }
    }, // success
    error: function (xhr, status) {
      alert(xhr + ' : ' + status)
    },
  })
}

/**** 팝업 이동 ****/
// function serviceSubmit(targetUrl) {

//     var thisUrl = window.location.href;

//     if (thisUrl.indexOf("03_modeltype.php") != -1) {

//         if ($(':input:radio[name=model_send]:checked').val() != "impression") {
//           //  alert($(':input:radio[name=model_send]:checked').val());
//             if (maxilla_image_file != null || mandible_image_file != null) {

//                 //파일 등록처리
//                 var formData = new FormData();
//                 formData.append("model_send", "scan_file");
//                 if (maxilla_image_file != null) {
//                     formData.append(
//                         'maxilla_image_file',
//                         maxilla_image_file,
//                         maxilla_image_file.name
//                     );
//                     formData.append('maxilla_image_rot', maxilla_image_rot);
//                 }
//                 if (mandible_image_file != null) {
//                     formData.append(
//                         'mandible_image_file',
//                         mandible_image_file,
//                         mandible_image_file.name
//                     );
//                     formData.append('mandible_image_rot', mandible_image_rot);
//                 }

//                 $.ajax({
//                     url: 'service_file_upload.php',
//                     data : formData,
//                     enctype: 'multipart/form-data',
//                     type : 'post',
//                     contentType : false,
//                     processData: false,
//                     async: false,
//                     dataType:'html',
//                      success : function(data) {
//                        // alert("스캔파일  = "+data);
//                         if (data.indexOf("true") != -1) {
//                             location.href = targetUrl;
//                           }
//                       }
//                     });

//             } else {
//                 alert("스캔파일을 등록해 주세요.");
//                 return false;
//             }

//         }else{
//           //  alert($(':input:radio[name=model_send]:checked').val());
//             var formData = $("#service_info_form").serialize();
//             $.ajax({
//                 cache: false,
//                 url: "service_file_upload.php",
//                 type: 'POST',
//                 data: formData,
//                 dataType: 'html',
//                 success: function (data) {
//                     //alert("impression  = "+data);
//                     if (data.indexOf("true") != -1) {
//                         location.href = targetUrl;
//                     } else {
//                         alert('false');
//                     }
//                 }, // success
//                 error: function (xhr, status) {
//                     alert(xhr + " : " + status);
//                 }
//             });

//         }

//     }else if (thisUrl.indexOf("04_picture.php") != -1) {
//         location.href = targetUrl;
//     }else if (thisUrl.indexOf("05_radiograph.php") != -1) {
//         location.href = targetUrl;
//     }else{

//     if (thisUrl.indexOf("01_select.php") != -1) {
//         if (!nullChk01()) {return false; }
//     } else if (thisUrl.indexOf("02_patientinfo.php") != -1) {
//       //  if (!nullChk02()) { return false;}
//     } else if (thisUrl.indexOf("06_bracket.php") != -1) {
//        //  if(!nullChk06()){ return false;}
//     } else if (thisUrl.indexOf("07_setup1.php") != -1) {
//         //if(!nullChk07()){return false;}
//     } else if (thisUrl.indexOf("08_setup2.php") != -1) {
//         //if(!nullChk08()){return false;}
//     } else if (thisUrl.indexOf("09_result.php") != -1) {
//         //if(!nullChk09()){return false;}
//     }
//     //var formData = $("#service_info_form").serialize();
//    // $("#service_info_form").append("<input type='hidden' name='targetPage' value='"+targetUrl+"' />");
//     // var form  = document.service_info_form;
//     // form.action = "service_info.php";
//     // form.submit();
//     //$("#service_info_form").submit();

//     // $.ajax({
//     //     cache: false,
//     //     url: "service_info.php",
//     //     type: 'POST',
//     //     data: formData,
//     //     dataType: 'html',
//     //     success: function (data) {
//     //         //alert(data);
//     //         if (data == "true") {
//     //             location.href = targetUrl;
//     //         } else {
//     //             alert('false');
//     //         }
//     //     }, // success
//     //     error: function (xhr, status) {
//     //         alert(xhr + " : " + status);
//     //     }
//     // });
// }
// }

/**** 팝업 닫기 ****/
function servicePopupClose() {
  $.ajax({
    cache: false,
    url: 'service_info_delete.php',
    type: 'POST',
    data: {},
    dataType: 'html',
    success: function (data) {
      self.opener = self
      window.close()
    }, // success
    error: function (xhr, status) {
      alert(xhr + ' : ' + status)
    },
  })
  // if (confirm("The changes unsaved will not be stored.")) {
  // }
}

/***********************************
 서비스 null 처리 함수
 ***********************************/
function nullChk01() {
  if ($('#service_select').val() == '') {
    alert('서비스를 선택해 주세요.')
    $('#service_select').focus()
    return false
  } else {
    return true
  }
}

function nullChk02() {
  //     if ($("#patient_id").val() == "") {
  //        // alert("환자 아이디를 입력해 주세요.");
  //         $("#patient_id").focus();
  //         return false;
  //     } else if ($("#patient_name").val() == "") {
  //         alert("환자 이름을 입력해 주세요.");
  //         $('#patient_name').focus();
  //         return false;
  //     } else if (!$(":input:radio[name='patient_sex']:checked").val()) {
  //         alert("환자 성별을 선택해 주세요.");
  //         return false;
  //     } else if ($("#dental_lab").val() == null) {
  //         alert("기공소를 선택해 주세요.");
  //         return false;
  //     } else if ($("#patient_date_yy").val() == "") {
  //         alert("환자 생년월일을 입력해 주세요.");
  //         $('#patient_date_yy').focus();
  //         return false;
  //     } else if ($("#patient_date_mm").val() == "") {
  //         alert("환자 생년월일을 입력해 주세요.");
  //         return false;
  //     } else if ($("#patient_date_dd").val() == "") {
  //         alert("환자 생년월일을 입력해 주세요.");
  //         $('#patient_date_dd').focus();
  //         return false;
  //     } else {
  //         return true;
  //     }
}

function nullChk03() {
  if ($(':input:radio[name=model_send]:checked').val() != 'impression') {
    if (maxilla_image_file != null || mandible_image_file != null) {
      var result = false
      //파일 등록처리
      var formData = new FormData()
      if (maxilla_image_file != null) {
        formData.append('maxilla_image_file', maxilla_image_file, maxilla_image_file.name)
        formData.append('maxilla_image_rot', maxilla_image_rot)
      }
      if (mandible_image_file != null) {
        formData.append('mandible_image_file', mandible_image_file, mandible_image_file.name)
        formData.append('mandible_image_rot', mandible_image_rot)
      }

      $.ajax({
        url: '../service_file_upload.php',
        data: formData,
        enctype: 'multipart/form-data',
        type: 'post',
        contentType: false,
        processData: false,
        async: false,
        success: function (data) {
          //alert(data);
          if (data == 'true') {
            result = true
          } else if (data == 'false') {
            if (confirm('파일 저장중 오류가 발생했습니다.')) {
              result = true
            } else {
              result = false
            }
          }
        },
      })
      //f_result = true;

      return result
    } else {
      alert('Please add scan files.')
      return false
    }
  } else {
    return true
  }
}

function nullChk04() {
  // 사진등록 페이지 등록 안해도 넘어감
}

function nullChk05() {
  // 방사선 사진 등록 페이지 등록 안해도 넘어감
}

function nullChk06() {
  return brkListAppend()
}

function nullChk07() {
  if ($(':input:radio[name=extraction]:checked').val() == 'tooth_e') {
    var number_chek = false
    $('.number').each(function (e) {
      if ($(this).val() != '') {
        number_chek = true
      }
    })
    if (!number_chek) {
      alert('Please select teeth to extract')
      return false
    }
  }

  if ($('#Incisor').is(':checked')) {
    if (!$('#Central_incisor').is(':checked') && !$('#Lateral_incisor').is(':checked')) {
      alert('Please select a check box.')
      return false
    }
  }

  /*    if ($(':input:radio[name=upper_aw_ma]:checked').val() != "upper_aw_ma_na") {

            if (!$('input:radio[name=upper_aw_widen]').is(':checked')) {
                alert('Upper Widen 항목을 선택해주세요.');
                return false;
            }
            if (!$('input:radio[name=upper_aw_constrict]').is(':checked')) {
                alert('Upper Constrict 항목을 선택해주세요.');
                return false;
            }

        }
        if ($(':input:radio[name=lower_aw_ma]:checked').val() != "lower_aw_ma_na") {

            if (!$('input:radio[name=lower_aw_widen]').is(':checked')) {
                alert('Lower Widen 항목을 선택해주세요.');
                return false;
            }

            if (!$('input:radio[name=lower_aw_constrict]').is(':checked')) {
                alert('Lower Constrict 항목을 선택해주세요.');
                return false;
            }

        }*/

  return true
}

function nullChk08() {}

function nullChk09() {
  if ($(':input:radio[name=attchment_option]:checked').val() == 'select') {
    var number_chek = false
    $('.number').each(function (e) {
      if ($(this).val() != '') {
        number_chek = true
      }
    })
    if (!number_chek) {
      alert('Please select a number.')
      return false
    }
  }
}

function AdultNullChk12() {
  if ($(':input:radio[name=eruption_incisor_option]:checked').val() == 'provide') {
    var number_chek = false
    $('button[name=upperBrackets]').each(function (e) {
      if ($(this).val() != '') {
        number_chek = true
      }
    })
    $('button[name=lowerBrackets]').each(function (e) {
      if ($(this).val() != '') {
        number_chek = true
      }
    })

    /*if ($("input[name=incisor_select_number[]]").length > 0)
        {
            number_chek = true;
        }else number_chek = false;*/

    if (!number_chek) {
      alert('Please select a number.')
      return false
    }
  }

  if ($(':input:radio[name=eruption_molar_option]:checked').val() == 'provide') {
    var number_chek2 = false
    $('button[name=upperBrackets1]').each(function (e) {
      if ($(this).val() != '') {
        number_chek2 = true
      }
    })
    $('button[name=lowerBrackets1]').each(function (e) {
      if ($(this).val() != '') {
        number_chek2 = true
      }
    })

    if (!number_chek2) {
      alert('Please select a number.')
      return false
    }
  }
}

/***************************************************************************/

/******************************************
 02  환자정보 입력 나이 계산
 ******************************************/

function ageChange() {
  if (
    $('#patient_date_yy').val() != '' &&
    $('#patient_date_yy').val() != null &&
    $('#patient_date_mm').val() != '' &&
    $('#patient_date_mm').val() != null &&
    $('#patient_date_dd').val() != '' &&
    $('#patient_date_dd').val() != null
  ) {
    var today = new Date()
    var birthDate = new Date($('#patient_date_yy').val(), $('#patient_date_mm').val() - 1, $('#patient_date_dd').val() - 1)
    $('#patient_age').val(getWesternAge(birthDate))
  } else {
    $('#patient_age').val('')
  }
}

function getWesternAge(birthday) {
  // Date 객체인 birthday 를 매개변수로 받는 getWesternAge 함수 생성
  let rightNow = new Date()
  let age = rightNow.getFullYear() - birthday.getFullYear()
  // 현재 연도에서 생일 연도를 뺀 값을 age 로 한다.
  let birthMonth = birthday.getMonth()
  let thisMonth = rightNow.getMonth()
  // 현재 월과 생일 월을 변수에 저장한다.
  let birthDate = birthday.getDate()
  let thisDate = rightNow.getDate()

  if (birthMonth < thisMonth) {
    return age
  } else if (birthMonth > thisMonth) {
    return age - 1
  } else {
    if (birthDate < thisDate) {
      return age
    } else {
      return age - 1
    }
  }
}

/******************************************
 03  모델타입 선택
 ******************************************/

function selectModelType() {
  if ($(':input:radio[name=model_send]:checked').val() == 'scan_file') {
    $('#scan_file_div').css('display', '')
    $('#impression_div').css('display', 'none')
  } else if ($(':input:radio[name=model_send]:checked').val() == 'impression') {
    $('#scan_file_div').css('display', 'none')
    $('#impression_div').css('display', '')
  }
}

function filesUploadChecked() {
  if ($(':input:radio[name=model_send]:checked').val() != 'impression') {
    //파일 등록처리
    if (
      maxilla_image_file != null ||
      mandible_image_file != null ||
      document.getElementById('maxilla_image') ||
      document.getElementById('mandible_image')
    ) {
      return true
    } else {
      alert('Please add scan files')
      return false
    }
  }
}

/******************************************
 04 사진등록
 ******************************************/

/******************************************
 05 방사선 사진 등록
 ******************************************/

/******************************************
 06 브라켓
 ******************************************/
// upper 체크
function upperChecked() {
  if ($('#upperCheckBox').is(':checked') == true) {
    //Tray Sections 활성화
    $('input[name=upperTraySelectMenu]').each(function (i) {
      $(this).prop('disabled', false)
    })
    //11 ~ 28 버튼 활성화
    $('button[name=upperBrackets]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //11 ~ 28 버튼 활성화
    $('input[name=upperBrackets]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //11 ~ 28 버튼 활성화
    $('input[name=cp_upperBrackets]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //회사선택 활성화
    $('#brk_dental_lab').prop('disabled', false)
    $('#brk_dental_lab option:eq(0)').prop('selected', true)
    $('#brk_product option:eq(0)').prop('selected', true)
    $('#brk_product').prop('disabled', true)
  } else {
    if (confirm('입력하신 정보들이 사라집니다.')) {
      $.ajax({
        url: 'service_info.php',
        type: 'POST',
        data: { brk_info_delete: 'true' },
        dataType: 'html',
        success: function (data) {
          if (data == 'true') {
            alert('삭제되었습니다.')
            location.reload()
          }
        },
      })

      //Tray Sections 비 활성화
      $('input[name=upperTraySelectMenu]').each(function (i) {
        $(this).prop('disabled', true)
        if ($(this).val() == 'u_ts_1p') {
          $(this).prop('checked', true)
        } else {
          $(this).prop('checked', false)
        }
      })

      //11 ~ 28 버튼 비활성화
      $('button[name=upperBrackets]').each(function (i) {
        $(this).prop('disabled', true)
        $(this).css({ background: '' })
        $(this).val('')
      })
      //11 ~ 28 버튼 비활성화
      $('input[name=upperBrackets]').each(function (i) {
        $(this).prop('disabled', true)
        $(this).prop('checked', false)
      })

      //11 ~ 28 버튼 비활성화
      $('input[name=cp_upperBrackets]').each(function (i) {
        $(this).prop('disabled', true)
        $(this).prop('checked', false)
      })

      //brk_table_delete("upper");
      var num_list = ['11', '12', '13', '14', '15', '16', '17', '18', '21', '22', '23', '24', '25', '26', '27', '28']
      deduplication(num_list)
      var brk_info_list_tp = $('.cellcolor')

      brk_info_list_tp.each(function (i) {
        var tr = brk_info_list_tp.eq(i)
        var td = tr.children()
        var str_brk_numbers = td.eq(3).text()
        var color_key = brk_color_list(i + 1)

        brk_color_append(i + 1, str_brk_numbers)
        td.eq(0).text(i + 1)
        td.eq(4).remove()
        tr.append("<td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td>")
      })

      $('#brk_dental_lab option:eq(0)').prop('selected', true)
      $('#brk_product option:eq(0)').prop('selected', true)
      $('#brk_product').prop('disabled', true)

      //둘다 선택 안되있을경우
      if ($('#lowerCheckBox').is(':checked') != true) {
        $('#brk_dental_lab').prop('disabled', true)
        brk_table_delete('lower')
      }
    } else {
      $('#upperCheckBox').prop('checked', true)
      return
    }
  }
}

//lower 체크
function lowerChecked() {
  if ($('#lowerCheckBox').is(':checked') == true) {
    //Tray Sections 활성화
    $('input[name=lowerTraySelectMenu]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //31 ~ 48 버튼 활성화
    $('button[name=lowerBrackets]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //31 ~ 48 버튼 활성화
    $('input[name=lowerBrackets]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //31 ~ 48 버튼 활성화
    $('input[name=cp_lowerBrackets]').each(function (i) {
      $(this).prop('disabled', false)
    })

    //회사선택 활성화
    $('#brk_dental_lab').prop('disabled', false)
    $('#brk_dental_lab option:eq(0)').prop('selected', true)
    $('#brk_product option:eq(0)').prop('selected', true)
    $('#brk_product').prop('disabled', true)
  } else {
    if (confirm('입력하신 정보들이 사라집니다.')) {
      $.ajax({
        url: 'service_info.php',
        type: 'POST',
        data: { brk_info_delete: 'true', del_lower: 'true' },
        dataType: 'html',
        success: function (data) {
          if (data == 'true') {
            alert('삭제되었습니다.')
          }
        },
      })

      //Tray Sections 비 활성화
      $('input[name=lowerTraySelectMenu]').each(function (i) {
        $(this).prop('disabled', true)
        if ($(this).val() == 'l_ts_1p') {
          $(this).prop('checked', true)
        } else {
          $(this).prop('checked', false)
        }
      })

      //31 ~ 48 버튼 비활성화
      $('button[name=lowerBrackets]').each(function (i) {
        $(this).prop('disabled', true)
        $(this).css({ background: '' })
        $(this).val('')
      })

      //31 ~ 48 버튼 비활성화
      $('input[name=lowerBrackets]').each(function (i) {
        $(this).prop('disabled', true)
        $(this).prop('checked', false)
      })

      //31 ~ 48 버튼 비활성화
      $('input[name=cp_lowerBrackets]').each(function (i) {
        $(this).prop('disabled', true)
        $(this).prop('checked', false)
      })

      var num_list = ['31', '32', '33', '34', '35', '36', '37', '38', '41', '42', '43', '44', '45', '46', '47', '48']

      deduplication(num_list)
      var brk_info_list_tp = $('.cellcolor')

      brk_info_list_tp.each(function (i) {
        var tr = brk_info_list_tp.eq(i)
        var td = tr.children()
        var str_brk_numbers = td.eq(3).text()
        var color_key = brk_color_list(i + 1)

        brk_color_append(i + 1, str_brk_numbers)
        td.eq(0).text(i + 1)
        td.eq(4).remove()
        tr.append("<td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td>")
      })
      //brk_table_delete("lower");

      $('#brk_dental_lab option:eq(0)').prop('selected', true)
      $('#brk_product option:eq(0)').prop('selected', true)
      $('#brk_product').prop('disabled', true)

      //둘다 선택 아닐경우
      if ($('#upperCheckBox').is(':checked') != true) {
        brk_table_delete('upper')
        $('#brk_dental_lab').prop('disabled', true)
        //$('#bracket_table tbody tr').remove();
      }
    } else {
      $('#lowerCheckBox').prop('checked', true)
      return
    }
  }
}

//전체 삭제
function brkInfoDelete() {
  $('#brk_dental_lab option:eq(0)').prop('selected', true)
  $('#brk_product option:eq(0)').prop('selected', true)
  $('.number').each(function (i) {
    $(this).css({ background: '' })
    $(this).val('')
  })

  $('#bracket_table tbody tr').remove()
}

// 회사선택
function brk_selectedDentalLab() {
  //삭제버튼 활성화
  if ($('#brk_dental_lab').val() != '') {
    $('#btn_brk_info_delete').prop('disabled', false)
  }
  // 사용자 지정일경우 레이어팝업
  if ($('#brk_dental_lab').val() == 'brk_custom_dental_lab') {
    $('.modal_wrap').css('display', 'block')
  } else {
    // 제품정보 불러오기
    var checkeUL = ''

    if ($('#lowerCheckBox').is(':checked') && $('#upperCheckBox').is(':checked')) checkeUL = 'UL'
    else if ($('#upperCheckBox').is(':checked')) {
      checkeUL = 'U'
    } else {
      checkeUL = 'L'
    }

    $.ajax({
      url: 'brk_product_list.php',
      type: 'POST',
      data: {
        brk_dental_lab_id: $('#brk_dental_lab').val(),
        checked: checkeUL,
      },
      dataType: 'json',
      success: function (data) {
        //alert(data.Bracket[0].COMPANY_ID);
        if (data.Bracket.length > 0) {
          $('#brk_product').find('option').remove()
          $('#brk_product').append("<option value='' selected disabled hidden>선택 해주세요.</option>")
          for (let index = 0; index < data.Bracket.length; index++) {
            $('#brk_product').append('<option value=' + data.Bracket[index]['code'] + '>' + data.Bracket[index]['B_NAME'] + '</option>')
          }
          $('#brk_product').append(" <option value='brk_custom_product' >사용자 지정</option>")
          $('#brk_product').prop('disabled', false)
        }
      },
    })
  }
}

//상악 하악 체크 해제
function brk_table_delete(select_result) {
  var num_list = []

  if (select_result == 'upper') {
    num_list = ['11', '12', '13', '14', '15', '16', '17', '18', '21', '22', '23', '24', '25', '26', '27', '28']
  } else if (select_result == 'lower') {
    num_list = ['31', '32', '33', '34', '35', '36', '37', '38', '41', '42', '43', '44', '45', '46', '47', '48']
  }

  var brk_info_list = $('.cellcolor')

  brk_info_list.each(function (i) {
    var tr = brk_info_list.eq(i)
    var td = tr.children()
    var brk_numbers = td.eq(3).text()

    //  - , 전부있는경우
    if (brk_numbers.indexOf('-') != -1 && brk_numbers.indexOf(',') != -1) {
      var list_size = brk_numbers.split(',')
      var result = false
      var number_list = []

      for (let index = 0; index < list_size.length; index++) {
        if (list_size[index].indexOf('-') != -1) {
          var list_iner_numbers = list_size[index].split('-')
          var start_num = list_iner_numbers[0]
          var end_num = list_iner_numbers[1]

          for (let j = start_num; j <= end_num; j++) {
            number_list.push(j)
          }
        } else {
          number_list.push(list_size[index])
        }
      }

      number_list.sort()

      for (let f = 0; f < num_list.length; f++) {
        for (let index = 0; index < number_list.length; index++) {
          if (num_list[f] == number_list[index]) {
            result = true
            break
          }
        }
      }

      if (result) {
        brk_info_list.eq(i).remove()
      }

      // - 만 포함인경우 ex) 11 - 13 구분없음
    } else if (brk_numbers.indexOf('-') != -1 && brk_numbers.indexOf(',') == -1) {
      var nums = brk_numbers.split('-')
      var result = false
      var number_list = []

      var start_num = nums[0]
      var end_num = nums[1]

      for (let j = start_num; j <= end_num; j++) {
        number_list.push(j)
      }
      number_list.sort()

      for (let f = 0; f < num_list.length; f++) {
        for (let index = 0; index < number_list.length; index++) {
          if (num_list[f] == number_list[index]) {
            result = true
            break
          }
        }
      }

      if (result) {
        brk_info_list.eq(i).remove()
      }

      // , 만 포함인경우 ex) 11,15,21 구분없음
    } else if (brk_numbers.indexOf(',') != -1 && brk_numbers.indexOf('-') == -1) {
      var nums = brk_numbers.split(',')

      var number_list = []

      for (let j = 0; j < nums.length; j++) {
        number_list.push(nums[j])
      }

      number_list.sort()

      for (let f = 0; f < num_list.length; f++) {
        for (let index = 0; index < number_list.length; index++) {
          if (num_list[f] == number_list[index]) {
            result = true
            break
          }
        }
      }

      if (result) {
        brk_info_list.eq(i).remove()
      }
    } else {
      for (let f = 0; f < num_list.length; f++) {
        if (brk_numbers == num_list[f]) {
          brk_info_list.eq(i).remove()
          break
        }
      }
    }
  })
  /////////durl
  var brk_info_list_tp = $('.cellcolor')

  brk_info_list_tp.each(function (i) {
    var tr = brk_info_list_tp.eq(i)
    var td = tr.children()
    var str_brk_numbers = td.eq(3).text()
    var color_key = brk_color_list(i + 1)

    brk_color_append(i + 1, str_brk_numbers)
    td.eq(0).text(i + 1)
    td.eq(4).remove()
    tr.append("<td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td>")
  })
}

function brk_color_append(table_number, brk_nums) {
  var color_key = brk_color_list(table_number)

  if (brk_nums.indexOf('-') != -1 && brk_nums.indexOf(',') != -1) {
    var list_size = brk_nums.split(',')
    var list_numbers = ''
    for (let index = 0; index < list_size.length; index++) {
      if (list_size[index].indexOf('-') != -1) {
        var nums = list_size[index].split('-')
        var startPoint = Number(nums[0])
        var endPoint = Number(nums[1])

        for (let index = startPoint; index <= endPoint; index++) {
          $('#brk_' + index).css('background-color', color_key)
          $('#brk_' + index).val('true')
        }
      } else {
        $('#brk_' + list_size[index]).css('background-color', color_key)
        $('#brk_' + list_size[index]).val('true')
      }
    }
  } else if (brk_nums.indexOf('-') != -1 && brk_nums.indexOf(',') == -1) {
    var nums = brk_nums.split('-')
    var startPoint = Number(nums[0])
    var endPoint = Number(nums[1])
    for (let index = startPoint; index <= endPoint; index++) {
      $('#brk_' + index).css('background-color', color_key)
      $('#brk_' + index).val('true')
    }
  } else if (brk_nums.indexOf(',') != -1 && brk_nums.indexOf('-') == -1) {
    var nums = brk_nums.split(',')
    var numsIntArray = []
    for (let index = 0; index < nums.length; index++) {
      numsIntArray.push(Number(nums[index]))
    }
    numsIntArray.sort()
    for (let i = 0; i < numsIntArray.length; i++) {
      $('#brk_' + numsIntArray[i]).css('background-color', color_key)
      $('#brk_' + numsIntArray[i]).val('true')
    }
  } else if (brk_nums.indexOf('#') != -1) {
    //alert('브라켓에 색 집어넣기 에러 ID 없음 ERRROROORER!!!!!!!!!!!!!!!!!!!!!!!!!!!');
    var num = brk_nums.split('(', 2)
    $('#brk_' + num[0]).css('background-color', color_key)
    $('#brk_' + num[0]).val('true')
  } else {
    $('#brk_' + brk_nums).css('background-color', color_key)
    $('#brk_' + brk_nums).val('true')
  }
}

function brk_color_list(table_number) {
  while (table_number > 10) {
    table_number -= 10
  }
  var color_key = ''
  switch (table_number) {
    case 1:
      color_key = 'rgb(72,142,204)'
      break

    case 2:
      color_key = 'rgb(225,86,70)'
      break

    case 3:
      color_key = 'rgb(233,210,0)'
      break

    case 4:
      color_key = 'rgb(0,149,20)'
      break

    case 5:
      color_key = 'rgb(130,45,241)'
      break

    case 6:
      color_key = 'rgb(255,162,0)'
      break

    case 7:
      color_key = 'rgb(28,80,255)'
      break

    case 8:
      color_key = 'rgb(255,114,255)'
      break

    case 9:
      color_key = 'rgb(0,187,130)'
      break

    case 10:
      color_key = 'rgb(152,101,0)'
      break

    case 11:
      color_key = 'rgb(204,72,134)'
      break
    case 12:
      color_key = 'rgb(146,130,27)'
      break
    case 13:
      color_key = 'rgb(61,0,233)'
      break
    case 14:
      color_key = 'rgb(252,20,20)'
      break
    case 15:
      color_key = 'rgb(45,234,241)'
      break
    case 16:
      color_key = 'rgb(255,238,0)'
      break
    case 17:
      color_key = 'rgb(118,142,222)'
      break
    case 18:
      color_key = 'rgb(85,64,157)'
      break
    case 19:
      color_key = 'rgb(187,0,0)'
      break
    case 20:
      color_key = 'rgb(123,152,251)'
      break
    case 21:
      color_key = 'rgb(72,204,186)'
      break

    case 22:
      color_key = 'rgb(45,18,15)'
      break
    case 23:
      color_key = 'rgb(0,136,255)'
      break
    case 24:
      color_key = 'rgb(0,65,149)'
      break
    case 25:
      color_key = 'rgb(150,241,45)'
      break
    case 26:
      color_key = 'rgb(188,12,207)'
      break
    case 27:
      color_key = 'rgb(25,132,255)'
      break
    case 28:
      color_key = 'rgb(27,158,84)'
      break
    case 29:
      color_key = 'rgb(187,162,0)'
      break
    case 30:
      color_key = 'rgb(24,0,152)'
      break
    case 31:
      color_key = 'rgb(255,111,0)'
      break
    case 32:
      color_key = 'rgb(4,85,120)'
      break

    default:
      color_key = 'red'
      break
  }

  return color_key
}

function brk_ind_selec_num() {
  $('#brk_indi_num').find('option').remove()
  // 제품정보 불러오기
  var checkeUL = ''
  if ($('#lowerCheckBox').is(':checked') && $('#upperCheckBox').is(':checked')) {
    checkeUL = 'UL'
    $('#brk_indi_num').append(
      "\
        <option  value='" +
        $('#brk_indi_select_target').val() +
        "' selected >" +
        $('#brk_indi_select_target').val() +
        "</option>    \
        <option  value='11' >11</option> \
        <option  value='12' >12</option>\
        <option  value='13' >13</option>\
        <option  value='14' >14</option>\
        <option  value='15' >15</option>\
        <option  value='16' >16</option>\
        <option  value='17' >17</option>\
        <option  value='18' >18</option>\
        <option  value='21' >21</option>\
        <option  value='22' >22</option>\
        <option  value='23' >23</option>\
        <option  value='24' >24</option>\
        <option  value='25' >25</option>\
        <option  value='26' >26</option>\
        <option  value='27' >27</option>\
        <option  value='28' >28</option>\
        <option  value='31' >31</option>\
        <option  value='32' >32</option>\
        <option  value='33' >33</option>\
        <option  value='34' >34</option>\
        <option  value='35' >35</option>\
        <option  value='36' >36</option>\
        <option  value='37' >37</option>\
        <option  value='38' >38</option>\
        <option  value='41' >41</option>\
        <option  value='42' >42</option>\
        <option  value='43' >43</option>\
        <option  value='44' >44</option>\
        <option  value='45' >45</option>\
        <option  value='46' >46</option>\
        <option  value='47' >47</option>\
        <option  value='48' >48</option>\
        "
    )
  } else if ($('#upperCheckBox').is(':checked')) {
    checkeUL = 'U'
    $('#brk_indi_num').append(
      '\
         <option  value=' +
        $('#brk_indi_select_target').val() +
        ' selected hidden>' +
        $('#brk_indi_select_target').val() +
        "</option>    \
        <option  value='11' >11</option> \
        <option  value='12' >12</option>\
        <option  value='13' >13</option>\
        <option  value='14' >14</option>\
        <option  value='15' >15</option>\
        <option  value='16' >16</option>\
        <option  value='17' >17</option>\
        <option  value='18' >18</option>\
        <option  value='21' >21</option>\
        <option  value='22' >22</option>\
        <option  value='23' >23</option>\
        <option  value='24' >24</option>\
        <option  value='25' >25</option>\
        <option  value='26' >26</option>\
        <option  value='27' >27</option>\
        <option  value='28' >28</option>\
        "
    )
  } else {
    checkeUL = 'L'
    $('#brk_indi_num').append(
      '\
         <option  value=' +
        $('#brk_indi_select_target').val() +
        ' selected hidden>' +
        $('#brk_indi_select_target').val() +
        "</option>    \
        <option  value='31' >31</option>\
        <option  value='32' >32</option>\
        <option  value='33' >33</option>\
        <option  value='34' >34</option>\
        <option  value='35' >35</option>\
        <option  value='36' >36</option>\
        <option  value='37' >37</option>\
        <option  value='38' >38</option>\
        <option  value='41' >41</option>\
        <option  value='42' >42</option>\
        <option  value='43' >43</option>\
        <option  value='44' >44</option>\
        <option  value='45' >45</option>\
        <option  value='46' >46</option>\
        <option  value='47' >47</option>\
        <option  value='48' >48</option>\
        "
    )
  }
}

// 개별선택 -> 회사선택
function brk_indi_selectDentalLab() {
  //삭제버튼 활성화
  if ($('#brk_indi_dental_lab').val() != '') {
    $('#btn_brk_info_delete').prop('disabled', false)
  }
  // 제품정보 불러오기
  var checkeUL = ''

  if ($('#lowerCheckBox').is(':checked') && $('#upperCheckBox').is(':checked')) checkeUL = 'UL'
  else if ($('#upperCheckBox').is(':checked')) {
    checkeUL = 'U'
  } else {
    checkeUL = 'L'
  }
  return $.ajax({
    url: 'brk_product_list.php',
    type: 'POST',
    data: {
      brk_dental_lab_id: $('#brk_indi_dental_lab').val(),
      checked: checkeUL,
    },
    dataType: 'json',
    success: function (data) {
      //alert(data.Bracket[0].COMPANY_ID);
      if (data.Bracket.length > 0) {
        $('#brk_indi_product').find('option').remove()
        $('#brk_indi_product').append("<option value='' selected disabled hidden>선택 해주세요.</option>")
        for (let index = 0; index < data.Bracket.length; index++) {
          $('#brk_indi_product').append('<option value=' + data.Bracket[index]['code'] + '>' + data.Bracket[index]['B_NAME'] + '</option>')
        }
        $('#brk_indi_product').prop('disabled', false)
      }
    },
  })
}

function brk_c_dl_confirm() {
  if ($('#brk_selected_custom_lab').val() == '') {
    alert('회사명을 입력해 주세요.')
    $('#brk_selected_custom_lab').focus()
    return
  } else if ($('#brk_selected_cl_product').val() == '') {
    alert('제품명을 입력해 주세요.')
    $('#brk_selected_cl_product').focus()
    return
  }
  var numChecked = false
  var num_arry = ''
  var num_arrys = []
  $('input[name=upperBrackets]').each(function (i) {
    if ($(this).is(':checked')) {
      numChecked = true
      // if(num_arry == ""){     num_arry = $(this).val(); }else if(num_arry != ""){
      // num_arry += ","+$(this).val();}
      num_arrys.push(Number($(this).val()))
    }
  })
  $('input[name=lowerBrackets]').each(function (i) {
    if ($(this).is(':checked')) {
      numChecked = true
      // if(num_arry == ""){     num_arry = $(this).val(); }else if(num_arry != ""){
      // num_arry += ","+$(this).val();}
      num_arrys.push(Number($(this).val()))
    }
  })

  if (!numChecked) {
    alert('Please select a number.')
    return
  }

  var temp = []
  num_arrys.sort()
  var num_arrys_tp = []
  for (let index = 0; index < num_arrys.length; index++) {
    num_arrys_tp.push(String(num_arrys[index]))
  }

  //기존 리스트에서 중복제거
  deduplication(num_arrys_tp)

  for (let j = 0; j < num_arrys.length; j++) {
    var next_index_number = j + 1
    var pre_index_nember = j - 1
    if (next_index_number <= num_arrys.length) {
      var next_index_val = num_arrys[next_index_number]
      var next_number = num_arrys[j] + 1

      if (pre_index_nember >= 0) {
        var pre_index_val = num_arrys[pre_index_nember]
        var pre_index_val_next = pre_index_val + 1
      }

      if (next_index_val == next_number) {
        temp.push(num_arrys[j])
      } else if (pre_index_val_next == num_arrys[j]) {
        temp.push(num_arrys[j])
        var temp_length = temp.length - 1
        if (num_arry == '') {
          num_arry = temp[0] + '-' + temp[temp_length]
        } else if (num_arry != '') {
          num_arry += ',' + temp[0] + '-' + temp[temp_length]
        }
        temp.splice(0, temp.length)
      } else {
        if (num_arry == '') {
          num_arry = String(num_arrys[j])
        } else if (num_arry != '') {
          num_arry += ',' + String(num_arrys[j])
        }
      }
    }
  }

  var user_custom = 1

  list_append(num_arry, user_custom)
  $('.modal_wrap').css('display', 'none')
}

function brk_c_product_confirm() {
  if ($('#brk_custom_product').val() == '') {
    alert('제품명을 입력해 주세요.')
    $('#brk_custom_product').focus()
    return
  }
  var numChecked = false
  var num_arry = ''
  var num_arrys = []
  $('input[name=cp_upperBrackets]').each(function (i) {
    if ($(this).is(':checked')) {
      numChecked = true
      // if(num_arry == ""){     num_arry = $(this).val(); }else if(num_arry != ""){
      // num_arry += ","+$(this).val();}
      num_arrys.push(Number($(this).val()))
    }
  })
  $('input[name=cp_lowerBrackets]').each(function (i) {
    if ($(this).is(':checked')) {
      numChecked = true
      // if(num_arry == ""){     num_arry = $(this).val(); }else if(num_arry != ""){
      // num_arry += ","+$(this).val();}
      num_arrys.push(Number($(this).val()))
    }
  })

  if (!numChecked) {
    alert('Please select teeth to extract')
    return
  }

  var temp = []
  num_arrys.sort()
  var num_arrys_tp = []
  for (let index = 0; index < num_arrys.length; index++) {
    num_arrys_tp.push(String(num_arrys[index]))
  }

  //기존 리스트에서 중복제거
  deduplication(num_arrys_tp)

  for (let j = 0; j < num_arrys.length; j++) {
    var next_index_number = j + 1
    var pre_index_nember = j - 1
    if (next_index_number <= num_arrys.length) {
      var next_index_val = num_arrys[next_index_number]
      var next_number = num_arrys[j] + 1

      if (pre_index_nember >= 0) {
        var pre_index_val = num_arrys[pre_index_nember]
        var pre_index_val_next = pre_index_val + 1
      }

      if (next_index_val == next_number) {
        temp.push(num_arrys[j])
      } else if (pre_index_val_next == num_arrys[j]) {
        temp.push(num_arrys[j])
        var temp_length = temp.length - 1
        if (num_arry == '') {
          num_arry = temp[0] + '-' + temp[temp_length]
        } else if (num_arry != '') {
          num_arry += ',' + temp[0] + '-' + temp[temp_length]
        }
        temp.splice(0, temp.length)
      } else {
        if (num_arry == '') {
          num_arry = String(num_arrys[j])
        } else if (num_arry != '') {
          num_arry += ',' + String(num_arrys[j])
        }
      }
    }
  }

  var user_custom = 2

  list_append(num_arry, user_custom)
  $('.modal_wrap_product').css('display', 'none')
}

//srt 배열 현재 테이블 중복값 제거
function deduplication(num_arrys) {
  var brk_info_list = $('.cellcolor')

  for (let fi = 0; fi < num_arrys.length; fi++) {
    brk_info_list.each(function (i) {
      var tr = brk_info_list.eq(i)
      var td = tr.children()
      var brk_numbers = td.eq(3).text()

      //  - , 전부있는경우
      if (brk_numbers.indexOf('-') != -1 && brk_numbers.indexOf(',') != -1) {
        var list_size = brk_numbers.split(',')

        var number_list = []

        for (let index = 0; index < list_size.length; index++) {
          if (list_size[index].indexOf('-') != -1) {
            var list_iner_numbers = list_size[index].split('-')
            var start_num = list_iner_numbers[0]
            var end_num = list_iner_numbers[1]

            for (let j = start_num; j <= end_num; j++) {
              number_list.push(j)
            }
          } else {
            number_list.push(list_size[index])
          }
        }

        number_list.sort()

        for (let f = 0; f < number_list.length; f++) {
          if (number_list[f] == num_arrys[fi]) {
            number_list.splice(f, 1)
            td.eq(3).text(numberSorting(number_list))
            break
          }
        }

        // - 만 포함인경우 ex) 11 - 13 구분없음
      } else if (brk_numbers.indexOf('-') != -1 && brk_numbers.indexOf(',') == -1) {
        var nums = brk_numbers.split('-')

        var number_list = []

        var start_num = nums[0]
        var end_num = nums[1]

        for (let j = start_num; j <= end_num; j++) {
          number_list.push(j)
        }
        number_list.sort()

        for (let f = 0; f < number_list.length; f++) {
          if (number_list[f] == num_arrys[fi]) {
            number_list.splice(f, 1)
            td.eq(3).text(numberSorting(number_list))
            break
          }
        }
        // var sortingList = numberSorting(number_list);
        // td.eq(3).text(sortingList);

        // , 만 포함인경우 ex) 11,15,21 구분없음
      } else if (brk_numbers.indexOf(',') != -1 && brk_numbers.indexOf('-') == -1) {
        var nums = brk_numbers.split(',')

        var number_list = []

        for (let j = 0; j < nums.length; j++) {
          number_list.push(nums[j])
        }

        number_list.sort()

        for (let f = 0; f < number_list.length; f++) {
          if (number_list[f] == num_arrys[fi]) {
            number_list.splice(f, 1)
            td.eq(3).text(numberSorting(number_list))
            break
          }
        }

        // var sortingList = numberSorting(number_list);
        // td.eq(3).text(sortingList);

        // 교체
      } else if (brk_numbers.indexOf('#') != -1) {
        //alert('중복값 제거 할려고 테이블 검색하는데 오류남 ERRROROORER!!!!!!!!!!!!!!!!!!!!!!!!!!!');
        var num = brk_numbers.split('(', 2)
        if (num[0] == num_arrys[fi]) {
          brk_info_list.eq(i).remove()
        }

        // 단일인 경우 ex) 15 단일인경우 단일비교 후 처리
      } else {
        if (brk_numbers == num_arrys[fi]) {
          brk_info_list.eq(i).remove()
        }
        //alert("단일");
      }
    })
  }
}

function numberSorting(st_num_arrys) {
  var num_arrys = []
  for (let index = 0; index < st_num_arrys.length; index++) {
    num_arrys.push(Number(st_num_arrys[index]))
  }

  var num_arry = ''
  var temp = []
  for (let j = 0; j < num_arrys.length; j++) {
    var next_index_number = j + 1
    var pre_index_nember = j - 1
    if (next_index_number <= num_arrys.length) {
      var next_index_val = num_arrys[next_index_number]
      var next_number = num_arrys[j] + 1

      if (pre_index_nember >= 0) {
        var pre_index_val = num_arrys[pre_index_nember]
        var pre_index_val_next = pre_index_val + 1
      }

      if (next_index_val == next_number) {
        temp.push(num_arrys[j])
      } else if (pre_index_val_next == num_arrys[j]) {
        temp.push(num_arrys[j])
        var temp_length = temp.length - 1
        if (num_arry == '') {
          num_arry = temp[0] + '-' + temp[temp_length]
        } else if (num_arry != '') {
          num_arry += ',' + temp[0] + '-' + temp[temp_length]
        }
        temp.splice(0, temp.length)
      } else {
        if (num_arry == '') {
          num_arry = String(num_arrys[j])
        } else if (num_arry != '') {
          num_arry += ',' + String(num_arrys[j])
        }
      }
    }
  }

  return num_arry
}

//사용자 지정 레이어 팝업 닫기
function brk_c_dl_close() {
  $('#brk_dental_lab option:eq(0)').prop('selected', true)
  $('.modal_wrap').css('display', 'none')
}

function brk_c_product_close() {
  $('#brk_product option:eq(0)').prop('selected', true)
  $('.modal_wrap_product').css('display', 'none')
}

// 브라켓 제품선택
function brk_selectedProduct() {
  //제품 사용자 지정
  if ($('#brk_product').val() == 'brk_custom_product') {
    $('.modal_wrap_product').css('display', 'block')
  } else {
    if ($('#lowerCheckBox').is(':checked') && $('#upperCheckBox').is(':checked')) checkeUL = 'UL'
    else if ($('#upperCheckBox').is(':checked')) {
      checkeUL = 'U'
    } else {
      checkeUL = 'L'
    }

    $.ajax({
      url: 'brk_product_select.php',
      type: 'POST',
      data: {
        brk_product_id: $('#brk_product').val(),
        checked: checkeUL,
      },
      dataType: 'json',
      success: function (data) {
        //alert(data.Bracket[0].COMPANY_ID);
        if (data.Bracket_Number.length > 0) {
          var user_custom = 0
          var brk_number_list = ''
          var brk_num_list_tp = []
          for (let index = 0; index < data.Bracket_Number.length; index++) {
            // brk_num_list_tp.push(data.Bracket_Number[index]['bracketNo']);
            var nums = data.Bracket_Number[index]['bracketNo'].split('-')
            var start_num = nums[0]
            var end_num = nums[1]
            if (start_num == end_num) {
              brk_num_list_tp.push(start_num)
            } else {
              for (let j = start_num; j <= end_num; j++) {
                brk_num_list_tp.push(j)
              }
            }

            if (brk_number_list == '') {
              brk_number_list = data.Bracket_Number[index]['bracketNo']
            } else {
              brk_number_list += ',' + data.Bracket_Number[index]['bracketNo']
            }
          }

          brk_num_list_tp.sort()

          deduplication(brk_num_list_tp)
          var brk_info_list_tp = $('.cellcolor')

          brk_info_list_tp.each(function (i) {
            var tr = brk_info_list_tp.eq(i)
            var td = tr.children()
            var str_brk_numbers = td.eq(3).text()
            var color_key = brk_color_list(i + 1)

            brk_color_append(i + 1, str_brk_numbers)
            td.eq(0).text(i + 1)
            td.eq(4).remove()
            tr.append("<td><div style='display:inline-block; width: 20px;height: 20px;background-color:" + color_key + "'></div></td>")
          })

          list_append(brk_number_list, user_custom)
        }
      },
    })

    // 브라켓 색상추가, 리스트 추가
  }
}

// 개별선택 ->  브라켓 제품선택
function brk_indi_selectedProduct() {
  if ($('#lowerCheckBox').is(':checked') && $('#upperCheckBox').is(':checked')) checkeUL = 'UL'
  else if ($('#upperCheckBox').is(':checked')) {
    checkeUL = 'U'
  } else {
    checkeUL = 'L'
  }

  return $.ajax({
    url: 'brk_product_select.php',
    type: 'POST',
    data: {
      brk_product_id: $('#brk_product').val(),
      checked: checkeUL,
    },
    dataType: 'json',
    success: function (data) {
      //alert(data.Bracket[0].COMPANY_ID);
      if (data.Bracket_Number.length > 0) {
        var brk_number_list = ''
        for (let index = 0; index < data.Bracket_Number.length; index++) {
          if (brk_number_list == '') {
            brk_number_list = data.Bracket_Number[index]['bracketNo']
          } else {
            brk_number_list += ',' + data.Bracket_Number[index]['bracketNo']
          }
        }

        //$('#brk_indi_product').val(brk_number_list);
      }
      $('#brk_indi_num').prop('disabled', false)
    },
  })

  // 브라켓 색상추가, 리스트 추가
}

function list_append(brk_nums, user_custom) {
  var table_number = 1 + $('#bracket_table tbody tr').length
  var color_key = brk_color_list(table_number)

  if (brk_nums.indexOf('-') != -1 && brk_nums.indexOf(',') != -1) {
    var list_size = brk_nums.split(',')
    var list_numbers = ''
    for (let index = 0; index < list_size.length; index++) {
      if (list_size[index].indexOf('-') != -1) {
        var nums = list_size[index].split('-')
        var startPoint = Number(nums[0])
        var endPoint = Number(nums[1])

        if (startPoint == endPoint) {
          if (list_numbers == '') {
            list_numbers = startPoint
          } else if (list_numbers != '') {
            list_numbers += ',' + startPoint
          }
        } else {
          if (list_numbers == '') {
            list_numbers = list_size[index]
          } else if (list_numbers != '') {
            list_numbers += ',' + list_size[index]
          }
        }

        for (let index = startPoint; index <= endPoint; index++) {
          $('#brk_' + index).css('background-color', color_key)
          $('#brk_' + index).val('true')
        }
      } else {
        $('#brk_' + list_size[index]).css('background-color', color_key)
        $('#brk_' + list_size[index]).val('true')
        if (list_numbers == '') {
          list_numbers = list_size[index]
        } else if (list_numbers != '') {
          list_numbers += ',' + list_size[index]
        }
      }
    }

    if (user_custom == 1) {
      var tr =
        ' <tr class=cellcolor> \
                                    <td>' +
        table_number +
        '</td> \
                                    <td>' +
        $('#brk_selected_custom_lab').val() +
        '(사용자 지정)</td> \
                                    <td>' +
        $('#brk_selected_cl_product').val() +
        '(사용자 지정)</td> \
                                    <td>' +
        list_numbers +
        "</td> \
                                    <td><div style='display:inline-block;width: 20px;height: 20px;background-color:" +
        color_key +
        "'></div></td> \
                                </tr>"
    } else if (user_custom == 2) {
      var tr =
        ' <tr class=cellcolor> \
                                    <td>' +
        table_number +
        '</td> \
                                    <td>' +
        $('#brk_dental_lab option:checked').text() +
        '</td> \
                                    <td>' +
        $('#brk_custom_product').val() +
        '(사용자 지정)</td> \
                                    <td>' +
        list_numbers +
        "</td> \
                                    <td><div style='display:inline-block;width: 20px;height: 20px;background-color:" +
        color_key +
        "'></div></td> \
                                </tr>"
    } else {
      var tr =
        ' <tr class=cellcolor> \
                                    <td>' +
        table_number +
        '</td> \
                                    <td>' +
        $('#brk_dental_lab option:checked').text() +
        '</td> \
                                    <td>' +
        $('#brk_product option:checked').text() +
        '</td> \
                                    <td>' +
        list_numbers +
        "</td> \
                                    <td><div style='display:inline-block; width: 20px;height: 20px;background-color:" +
        color_key +
        "'></div></td> \
                                </tr>"
    }
    $('#brk_list_tbody').append(tr)
  } else if (brk_nums.indexOf('-') != -1 && brk_nums.indexOf(',') == -1) {
    var nums = brk_nums.split('-')
    var startPoint = Number(nums[0])
    var endPoint = Number(nums[1])
    for (let index = startPoint; index <= endPoint; index++) {
      $('#brk_' + index).css('background-color', color_key)
      $('#brk_' + index).val('true')
    }

    //테이블 추가
    if (user_custom == 1) {
      var tr =
        ' <tr class=cellcolor> \
                            <td>' +
        table_number +
        '</td> \
                            <td>' +
        $('#brk_selected_custom_lab').val() +
        '(사용자 지정)</td> \
                            <td>' +
        $('#brk_selected_cl_product').val() +
        '(사용자 지정)</td> \
                            <td>' +
        startPoint +
        '-' +
        endPoint +
        '</td> \
                            <td><div sty' +
        "le='display:inline-block; width: 20px;height: 20px;background-color:" +
        color_key +
        "'></div></td> \
                        </tr>\
                   " +
        '     '
    } else if (user_custom == 2) {
      var tr =
        ' <tr class=cellcolor> \
                            <td>' +
        table_number +
        '</td> \
                            <td>' +
        $('#brk_dental_lab option:checked').text() +
        '</td> \
                            <td>' +
        $('#brk_custom_product').val() +
        '(사용자 지정)</td> \
                            <td>' +
        startPoint +
        '-' +
        endPoint +
        '</td> \
                            <td><div sty' +
        "le='display:inline-block; width: 20px;height: 20px;background-color:" +
        color_key +
        "'></div></td> \
                        </tr>\
                   " +
        '     '
    } else {
      var tr =
        ' <tr class=cellcolor> \
                            <td>' +
        table_number +
        '</td> \
                            <td>' +
        $('#brk_dental_lab option:checked').text() +
        '</td> \
                            <td>' +
        $('#brk_product option:checked').text() +
        '</td> \
                            <td>' +
        startPoint +
        '-' +
        endPoint +
        "</td> \
                            <td><div style='display:inline-" +
        'block;width: 20px;height: 20px;background-color:' +
        color_key +
        "'></div></td>" +
        ' \
                    </tr>\
                    '
    }

    $('#brk_list_tbody').append(tr)
  } else if (brk_nums.indexOf(',') != -1 && brk_nums.indexOf('-') == -1) {
    var nums = brk_nums.split(',')
    var numsIntArray = []
    for (let index = 0; index < nums.length; index++) {
      numsIntArray.push(Number(nums[index]))
    }
    numsIntArray.sort()
    for (let i = 0; i < numsIntArray.length; i++) {
      $('#brk_' + numsIntArray[i]).css('background-color', color_key)
      $('#brk_' + numsIntArray[i]).val('true')
    }

    //테이블 추가
    if (user_custom == 1) {
      var tr =
        ' <tr class=cellcolor> \
    <td>' +
        table_number +
        '</td> \
<td>' +
        $('#brk_selected_custom_lab').val() +
        '(사용자 지정)</td> \
   ' +
        ' <td>' +
        $('#brk_selected_cl_product').val() +
        '(사용자 지정)</td> \
    <td>' +
        numsIntArray +
        "</td> \
    <td><div style='width: 20px;height: 20px;background" +
        '-color:' +
        color_key +
        "'></div></td> \
    </tr>\
    "
    } else if (user_custom == 2) {
      var tr =
        ' <tr class=cellcolor> \
            <td>' +
        table_number +
        '</td> \
<td>' +
        $('#brk_dental_lab option:checked').text() +
        '</td> \
           ' +
        ' <td>' +
        $('#brk_custom_product').val() +
        '(사용자 지정)</td> \
            <td>' +
        numsIntArray +
        "</td> \
            <td><div style='width: 20px;height: 20px;background" +
        '-color:' +
        color_key +
        "'></div></td> \
            </tr>\
            "
    } else {
      var tr =
        ' <tr class=cellcolor> \
    <td>' +
        table_number +
        '</td> \
<td>' +
        $('#brk_selected_custom_lab').val() +
        '</td> \
    <td>' +
        $('#brk_selected_cl_product').val() +
        '</td> \
    <td>' +
        numsIntArray +
        "</td> \
    <td><div style='width: 20px;height: 20px;background" +
        '-color:' +
        color_key +
        "'></div></td> \
    </tr>\
    "
    }

    $('#brk_list_tbody').append(tr)
  } else if (brk_nums.indexOf('#') != -1) {
    alert('ERRROROORER!!!!!!!!!!!!!!!!!!!!!!!!!!!')
  } else {
    $('#brk_' + brk_nums).css('background-color', color_key)
    $('#brk_' + brk_nums).val('true')

    if (user_custom == 1) {
      var tr =
        ' <tr class=cellcolor> \
    <td>' +
        table_number +
        '</td> \
<td>' +
        $('#brk_selected_custom_lab').val() +
        '(사용자 지정)</td> \
   ' +
        ' <td>' +
        $('#brk_selected_cl_product').val() +
        '(사용자 지정)</td> \
    <td>' +
        brk_nums +
        "</td> \
    <td><div style='width: 20px;height: 20px;background" +
        '-color:' +
        color_key +
        "'></div></td> \
    </tr>\
    "
    } else if (user_custom == 2) {
      var tr =
        ' <tr class=cellcolor> \
            <td>' +
        table_number +
        '</td> \
<td>' +
        $('#brk_dental_lab option:checked').text() +
        '</td> \
           ' +
        ' <td>' +
        $('#brk_custom_product').val() +
        '(사용자 지정)</td> \
            <td>' +
        brk_nums +
        "</td> \
            <td><div style='width: 20px;height: 20px;background" +
        '-color:' +
        color_key +
        "'></div></td> \
            </tr>\
            "
    } else {
      var tr =
        ' <tr class=cellcolor> \
    <td>' +
        table_number +
        '</td> \
<td>' +
        $('#brk_selected_custom_lab').val() +
        '</td> \
    <td>' +
        $('#brk_selected_cl_product').val() +
        '</td> \
    <td>' +
        brk_nums +
        "</td> \
    <td><div style='width: 20px;height: 20px;background" +
        '-color:' +
        color_key +
        "'></div></td> \
    </tr>\
    "
    }
    $('#brk_list_tbody').append(tr)
  }
}

function brkListAppend() {
  var brk_info_list = $('.cellcolor')
  var brt_table_size = $('#bracket_table tbody tr')
  if (!$('#upperCheckBox').is(':checked') && !$('#lowerCheckBox').is(':checked')) {
    alert('Indirect Bonding Tray(s)를 선택해 주세요.')
    return false
  }
  //alert($('#brk_dental_lab').val());

  if ($('#brk_dental_lab').val() == null && brt_table_size.length <= 0) {
    alert('회사를 선택해 주세요.')
    return false
  } else if ($('#brk_product').val() == null && brt_table_size.length <= 0) {
    alert('제품을 선택해 주세요.')
    return false
  }

  if (brt_table_size.length <= 0) {
    alert('브라켓을 선택해 주세요.')
    return false
  }

  brk_info_list.each(function (i) {
    var tr = brk_info_list.eq(i)
    var td = tr.children()

    // 체크된 row의 모든 값을 배열에 담는다.
    // rowData.push(tr.text());

    // td.eq(0)은 체크박스 이므로  td.eq(1)의 값부터 가져온다.
    var index = td.eq(0).text()
    var company_name = td.eq(1).text()
    var product_name = td.eq(2).text()
    var brk_numbers = td.eq(3).text()
    $('#service_info_form').append("<input type='hidden' name='brk_list_index[]' value='" + index + "'>")
    $('#service_info_form').append("<input type='hidden' name='brk_list_company_name[]' value='" + company_name + "'>")
    $('#service_info_form').append("<input type='hidden' name='brk_list_product_name[]' value='" + product_name + "'>")
    $('#service_info_form').append("<input type='hidden' name='brk_list_brk_numbers[]' value='" + brk_numbers + "'>")
    // alert(tr.text());
  })
  return true
}

/******************************************
 07 셋업 1
 ******************************************/
//비발치, 발치 선택
function select_tooth_extraction() {
  if ($(':input:radio[name=extraction]:checked').val() == 'none_tooth_e') {
    $('.number').each(function (i) {
      $(this).prop('disabled', true)
      $(this).css({ background: '' })
      if ($(this).text() == '') {
        $(this).text($(this).val())
        $(this).val('')
        $('#' + $(this).text()).remove()
      }
    })
  } else if ($(':input:radio[name=extraction]:checked').val() == 'tooth_e') {
    if ($('#upperChecked').val() == 'true' && $('#lowerChecked').val() == 'true') {
      $('.number').each(function (i) {
        $(this).prop('disabled', false)
      })
    } else if ($('#lowerChecked').val() == 'true') {
      $('button[name=lowerBrackets]').each(function (i) {
        $(this).prop('disabled', false)
      })
    } else if ($('#upperChecked').val() == 'true') {
      $('button[name=upperBrackets]').each(function (i) {
        $(this).prop('disabled', false)
      })
    }
  }
}

// Arch width Upper Maintain Asls 선택
function up_select_aw_ma() {
  if ($(':input:radio[name=upper_aw_ma]:checked').val() != 'upper_aw_ma_na') {
    $('input:radio[name=upper_aw_widen]').each(function (i) {
      $(this).prop('disabled', false)
    })
    $('input:radio[name=upper_aw_constrict]').each(function (i) {
      $(this).prop('disabled', false)
    })
  } else {
    $('input:radio[name=upper_aw_widen]').each(function (i) {
      $(this).prop('disabled', true)
      $(this).prop('checked', false)
    })
    $('input:radio[name=upper_aw_constrict]').each(function (i) {
      $(this).prop('disabled', true)
      $(this).prop('checked', false)
    })
  }
}

// Arch width Lower upper Maintain Asls 선택
function lo_select_aw_ma() {
  if ($(':input:radio[name=lower_aw_ma]:checked').val() != 'lower_aw_ma_na') {
    $('input:radio[name=lower_aw_widen]').each(function (i) {
      $(this).prop('disabled', false)
    })
    $('input:radio[name=lower_aw_constrict]').each(function (i) {
      $(this).prop('disabled', false)
    })
  } else {
    $('input:radio[name=lower_aw_widen]').each(function (i) {
      $(this).prop('disabled', true)
      $(this).prop('checked', false)
    })
    $('input:radio[name=lower_aw_constrict]').each(function (i) {
      $(this).prop('disabled', true)
      $(this).prop('checked', false)
    })
  }
}

/******************************************
 08 셋업 2
 ******************************************/

function overbiteSelect() {
  if ($(':input:radio[name=overbite]:checked').val() == 'Ideal') {
    $('#overbite_custom_n').prop('disabled', true)
    $('#overbite_custom_n').val('')
  } else {
    $('#overbite_custom_n').prop('disabled', false)
  }
}

function overjetSelect() {
  if ($(':input:radio[name=overjet]:checked').val() == 'Ideal') {
    $('#overjet_custom_n').prop('disabled', true)
    $('#overjet_custom_n').val('')
  } else {
    $('#overjet_custom_n').prop('disabled', false)
  }
}

/***********************************
 회원가입 관련
 ***********************************/

function signup_page_back(url) {
  var chenge = 0
  if (
    $('#first_name').val() != '' ||
    $('#last_name').val() != '' ||
    $('#member_pass').val() != '' ||
    $('#member_pass_ch').val() != '' ||
    $('#moblile_country_code option:selected').val() != '+1' ||
    $('#phone_number').val() != '' ||
    $('#member_hospital_name').val() != '' ||
    $('#country_id option:selected').val() != '' ||
    $('#address1').val() != '' ||
    $('#address2').val() != '' ||
    $('#address3').val() != '' ||
    $('#address4').val() != '' ||
    $('#postcode').val() != '' ||
    $('#phone_country_code option:selected').val() != '+1' ||
    $('#contact_number').val() != '' ||
    $('#all_selec').is(':checked') ||
    $('#agreement').is(':checked') ||
    $('#privacy').is(':checked') ||
    $('#marketing').is(':checked') ||
    $('#provision').is(':checked')
  ) {
    chenge = 1
  }
  if (chenge == 1) {
    if (confirm('Registered information will be deleted. Are you sure?')) {
      location.href = url
    } else return false
  } else {
    location.href = url
  }
}

/****  본인인증  ****/
window.name = 'Diorco_Web'
var KMCIS_window

function openKMCISWindow(_tr_cert, _tr_url) {
  var UserAgent = navigator.userAgent
  /* 모바일 접근 체크*/
  // 모바일일 경우 (변동사항 있을경우 추가 필요)
  if (
    UserAgent.match(
      /iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i
    ) != null ||
    UserAgent.match(/LG|SAMSUNG|Samsung/) != null
  ) {
    document.kmcSend.target = '' // 모바일이 아닐 경우
  } else {
    KMCIS_window = window.open(
      'https://www.kmcert.com/kmcis/web/kmcisReq.jsp?tr_cert=' + _tr_cert + '&tr_url=' + _tr_url,
      'KMCISWindow',
      'width=425, height=550, resizable=0, scrollbars=no, status=0, titlebar=0, toolb' + 'ar=0, left=435, top=250'
    )
    if (KMCIS_window == null) {
      alert(
        ' ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해' +
          ' 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.'
      )
    }

    document.kmcSend.target = 'KMCISWindow'
  }

  //  document.kmcSend.action = 'https://www.kmcert.com/kmcis/web/kmcisReq.jsp';
  document.kmcSend.submit()
}

function captcha_reload() {
  $('#login_captcha').load(document.URL + ' #login_captcha')
}

//아이디 중복 체크
function chk_id_() {
  if ($('#member_id').val() == '') {
    alert('아이디를 입력해 주세요.')
    $('#member_id').focus()
  } else if ($('#id_chk_value').val() == 'true') {
    $.ajax({
      url: '../viewmodels/checkUserId.php',
      type: 'POST',
      data: {
        member_id: $('#member_id').val(),
      },
      dataType: 'html',
      success: function (data) {
        // alert(data);
        if (data == 'true') {
          $('#id_ch_true').css('display', '')
          $('#id_ch_false').css('display', 'none')
        } else {
          $('#id_ch_true').css('display', 'none')
          $('#id_ch_false').css('display', '')
        }
      },
    })
  } else {
    alert('아이디 양식을 확인해 주세요.')
    $('#member_id').focus()
  }
}

function checkSignup() {
  var formData = $('#signup_info_form').serialize()
  //document.signup_info_form.submit();
  $.ajax({
    cache: false,
    url: '../viewmodels/signup.php',
    type: 'POST',
    data: formData,
    dataType: 'html',
    success: function (data) {
      //alert(data);
      if (data == '1') {
        alert('회원가입 신청이 완료되었습니다.')
        location.href = 'login.php'
      } else if (data == '-1') {
        alert('실패했습니다.')
      }
    }, // success
    error: function (xhr, status) {
      alert(xhr + ' : ' + status)
    },
  })
}

/*
function checkSignup() {

    if ($("#member_id").val() == "") {
        alert("아이디를 입력해주세요.");
        $('#member_id').focus();
        return false;
    } else if ($("#id_chk_value").val() == "") {
        alert("아이디 중복 검사를 해주세요.");
        $('#member_id').focus();
        return false;
    } else if ($("#member_hospital_name").val() == "") {
        alert("클리닉/병원 명 입력해주세요. ");
        $('#member_hospital_name').focus();
        return false;
    } else if ($("#member_name").val() == "") {
        alert("이름을 입력해주세요.");
        $('#member_name').focus();
        return false;
    } else if ($("#member_pass").val() == "") {
        alert("비밀번호를 입력해주세요.");
        $('#member_pass').focus();
        return false;
    } else if ($("#pw_chk_value").val() == "") {
        alert("사용할 수 없는 비밀번호 입니다.");
        $('#member_pass').focus();
        return false;
    } else if ($("#member_pass_ch").val() == "") {
        alert("비밀번호를 재확인해주세요.");
        $('#member_pass_ch').focus();
        return false;
    } else if ($("#pw_chk_").val() == "false") {
        alert("비밀번호를 재확인해주세요.");
        $('#member_pass_ch').focus();
        return false;
    } else if ($("#postcode").val() == "") {
        alert("우편번호를 입력해주세요.");
        $('#postcode').focus();
        return false;
    } else if ($("#roadAddress").val() == "") {
        alert("주소를 입력해주세요.");
        $('#roadAddress').focus();
        return false;
    } else if ($("#member_email").val() == "") {
        alert("이메일을 입력해주세요.");
        $('#member_email').focus();
        return false;
    } else if ($("#email_domain").val() == "") {
        alert("이메일 도메인을 입력해주세요.");
        $('#email_domain').focus();
        return false;
    } else if ($("#contact_number").val() == "") {
        alert("연락처를 입력해주세요.");
        $('#contact_number').focus();
        return false;
    } else if ($("#license_number").val() == "") {
        alert("면허 번호를 입력해주세요.");
        $('#license_number').focus();
        return false;
    }else if ($("#agreement").is(":checked") == false) {
        alert("약관을 체크해 주세요.");
        return false;
    }else if ($("#privacy").is(":checked") == false) {
        alert("약관을 체크해 주세요.");
        return false;
    }else if ($("#provision").is(":checked") == false) {
        alert("약관을 체크해 주세요.");
        return false;
    }


    


    var formData = $("#signup_info_form").serialize();
    //document.signup_info_form.submit();
    $.ajax({
        cache: false,
        url: "../viewmodels/signup.php",
        type: 'POST',
        data: formData,
        dataType: 'html',
        success: function (data) {
            //alert(data);
            if (data == "1") {
                alert('회원가입 신청이 완료되었습니다.');
                location.href = "login.php";
            } else if (data == "-1") {
                alert('알수없는 오류로 실패했습니다.');
            }
        }, // success
        error: function (xhr, status) {
            alert(xhr + " : " + status);
        }
    });
}
*/

function menuPopupOpen(targetUrl, cb = null) {
  window.open(
    targetUrl,
    'menuPopup',
    'height=' +
      (screen.availHeight || screen.height) +
      ',innerHeight=' +
      (screen.availWidth || screen.width) +
      ',width=' +
      (screen.availWidth || screen.width) +
      ',innerWidth=' +
      (screen.availWidth || screen.width) +
      ',fullscreen=yes'
  )
  if (cb) {
    cb()
  }
}

function insertCommet(gu) {
  var contents = $('#comment_area').val()

  //contents = contents.replace(/(\n|\r\n)/g, '<br>');
  if (contents.replace(/\sl /gi, '').length == 0 || $('#comment_area').val().replace(/\s/g, '').length == 0) {
    alert('Please enter the comments.')
    $('#comment_area').focus()
  } else {
    $.ajax({
      cache: false,
      url: '../viewmodels/patientComment.php',
      type: 'POST',
      data: { comment: contents, g: gu, s_key: $('#patientServiceKey').val() },
      dataType: 'html',
      success: function (data) {
        //alert(data);
        location.reload()
      }, // success
      error: function (xhr, status) {
        alert(xhr + ' : ' + status)
      },
    })
  }
}

function listSearch() {
  var str = regExp($('#search_q').val())
  $('#search_q').val(str)

  if ($('#btn_search').val() == 'x') {
    $('#search_q').val('')
  }

  return true
}

function regExp(str) {
  var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi
  //특수문자 검증
  if (reg.test(str)) {
    //특수문자 제거후 리턴
    return str.replace(reg, '')
  } else {
    //특수문자가 없으므로 본래 문자 리턴
    return str
  }
}

function resultSubmit(st, startProgressbar) {
  var ms = ''
  if (st == 20) {
    ms = 'Do you want to proceed with the order?'
  } else if (st == 21) {
    ms = 'Would you like to submit corrections?'
  }

  if (confirm(ms)) {
    if (startProgressbar) {
      startProgressbar()
    }

    const promise1 = $.ajax({
      cache: false,
      url: '/viewmodels/print.php',
      type: 'POST',
      data: { type: 'save' },
      dataType: 'text',
      success: function (data) {
        // @LUCAS 서비스 페이지 마지막에 Submit 하고 나서 환자 리스트로 보낸다.
        // location.href = "/views/index.php";
      }, // success
      error: function (xhr, status) {
        alert(data)
        alert('error')
        // alert(xhr + " : " + status);
      },
    })

    const promise2 = $.ajax({
      cache: false,
      url: 'service_info.php',
      type: 'POST',
      data: { input: 'true' },
      dataType: 'text',
      success: function (data) {
        // alert(data);
        // opener.parent.location.reload();
        // @LUCAS 서비스 페이지 마지막에 Submit 하고 나서 환자 리스트로 보낸다.
        // location.href = "/views/index.php";
        // opener.location.reload();
        // window.close();
      }, // success
      error: function (xhr, status) {
        // alert(xhr + " : " + status);
      },
    })

    Promise.all([promise1, promise2]).then((values) => {
      if (opener) {
        opener.location.reload()
        window.close()
      } else {
        location.href = '/views/index.php'
      }
    })
  } else {
    if (opener) {
      window.close()
    } else {
      location.href = '/views/index.php'
    }
    return
  }
}

function modelFileCheck(showMessage = true) {
  if ($(':input:radio[name=model_send]:checked').val() != 'impression') {
    if (maxilla_image_file == null && mandible_image_file == null) {
      if ($('#img_maxilla').length <= 0 && $('#img_mandible').length <= 0) {
        if (showMessage) alert('Please add scan files.')
        return false
      }
    }
  }
}

// @LUCAS 업로드 상태를 업데이트 하기 위해 xhr 을 생성한다.
function getXhrFunctionForUpload(uploadStatusCallback, showLog = false) {
  return function () {
    // @LUCAS 업로드 상태를 업데이트 받기 위해 xhr로 상태를 체크한다.
    const xhr = new window.XMLHttpRequest()
    // var xhr = $.ajaxSettings.xhr();
    if (!uploadStatusCallback || typeof uploadStatusCallback !== 'function') {
      return xhr
    }

    const updateStatus = (evt) => {
      if (evt.lengthComputable) {
        let percentComplete = evt.loaded / evt.total
        percentComplete = parseInt(percentComplete * 100)
        showLog && console.log('percentComplete', percentComplete)
        uploadStatusCallback(percentComplete)

        if (percentComplete === 100) {
          showLog && console.log('"wow end 100%"', 'wow end 100%')
        }
      }
    }
    xhr.upload.addEventListener('progress', updateStatus, false)

    return xhr
  }
}

// @LUCAS 1.5 다운로드 상태를 업데이트 하기 위해 xhr 을 생성한다.
function getXhrFunctionForDownload(uploadStatusCallback, showLog = false) {
  return function () {
    // @LUCAS 업로드 상태를 업데이트 받기 위해 xhr로 상태를 체크한다.
    const xhr = new window.XMLHttpRequest()
    // var xhr = $.ajaxSettings.xhr();
    if (!uploadStatusCallback || typeof uploadStatusCallback !== 'function') {
      return xhr
    }

    const updateStatus = (evt) => {
      if (evt.lengthComputable) {
        showLog && console.log('evt.loaded:' + evt.loaded, '/ evt.total:' + evt.total)
        let percentComplete = evt.loaded / evt.total
        percentComplete = parseInt(percentComplete * 100)
        showLog && console.log('percentComplete', percentComplete)
        uploadStatusCallback(percentComplete)

        if (percentComplete === 100) {
          showLog && console.log('"wow end 100%"', 'wow end 100%')
        }
      }
    }
    xhr.addEventListener('progress', updateStatus, false)

    return xhr
  }
}

// @LUCAS 업로드 상태를 업데이트 받기 위해 uploadStatusCallback 함수를 콜백으로 받는다.
async function modelUploadFiles(uploadStatusCallback) {
  if (maxilla_image_file != null || mandible_image_file != null) {
    //파일 등록처리
    var formData = new FormData()
    formData.append('model_send', 'scan_file')
    if (maxilla_image_file != null) {
      formData.append('maxilla_image_file', maxilla_image_file, maxilla_image_file.name)
    }
    if (mandible_image_file != null) {
      formData.append('mandible_image_file', mandible_image_file, mandible_image_file.name)
    }

    await $.ajax({
      url: '../service_file_upload.php',
      data: formData,
      enctype: 'multipart/form-data',
      type: 'post',
      contentType: false,
      processData: false,
      async: true /* @LUCAS 꼭 Async로 해야함. */,
      // dataType: 'html',
      success: function (data) {
        //alert(data);
        // if (data.indexOf("true") != -1) {
        //     location.href = targetUrl;
        //   }
      },
      xhr: getXhrFunctionForUpload(uploadStatusCallback),
    })
  } else return
}

// @LUCAS 업로드 상태를 업데이트 받기 위해 uploadStatusCallback 함수를 콜백으로 받는다.
async function picUploadFiles(uploadStatusCallback) {
  var formData = new FormData()
  if (
    lateral_image != null ||
    frontal_image != null ||
    smile_image != null ||
    intraoral_up_image != null ||
    intraoral_lo_image != null ||
    intraoral_ri_image != null ||
    intraoral_le_image != null ||
    intraoral_fr_image != null
  ) {
    //파일 등록처리
    if (lateral_image != null) {
      formData.append('lateral_image', lateral_image, lateral_image.name)
    }

    if (frontal_image != null) {
      formData.append('frontal_image', frontal_image, frontal_image.name)
    }

    if (smile_image != null) {
      formData.append('smile_image', smile_image, smile_image.name)
    }

    if (intraoral_up_image != null) {
      formData.append('intraoral_up_image', intraoral_up_image, intraoral_up_image.name)
    }

    if (intraoral_lo_image != null) {
      formData.append('intraoral_lo_image', intraoral_lo_image, intraoral_lo_image.name)
    }

    if (intraoral_ri_image != null) {
      formData.append('intraoral_ri_image', intraoral_ri_image, intraoral_ri_image.name)
    }

    if (intraoral_le_image != null) {
      formData.append('intraoral_le_image', intraoral_le_image, intraoral_le_image.name)
    }

    if (intraoral_fr_image != null) {
      formData.append('intraoral_fr_image', intraoral_fr_image, intraoral_fr_image.name)
    }
  }

  formData.append('lateral_image_rot', lateral_image_rot)
  formData.append('frontal_image_rot', frontal_image_rot)
  formData.append('smile_image_rot', smile_image_rot)
  formData.append('intraoral_up_image_rot', intraoral_up_image_rot)
  formData.append('intraoral_lo_image_rot', intraoral_lo_image_rot)
  formData.append('intraoral_ri_image_rot', intraoral_ri_image_rot)
  formData.append('intraoral_le_image_rot', intraoral_le_image_rot)
  formData.append('intraoral_fr_image_rot', intraoral_fr_image_rot)

  await $.ajax({
    url: '../service_file_upload.php',
    data: formData,
    enctype: 'multipart/form-data',
    type: 'post',
    contentType: false,
    processData: false,
    async: true /* @LUCAS 꼭 Async로 해야함. */,
    // dataType: 'html',
    success: function (data) {
      // alert(data);
      // if (data.indexOf("true") != -1) {
      //     location.href = targetUrl;
      //   }
    },
    xhr: getXhrFunctionForUpload(uploadStatusCallback),
  })
}

// @LUCAS 업로드 상태를 업데이트 받기 위해 uploadStatusCallback 함수를 콜백으로 받는다.
async function xrayUploadFiles(uploadStatusCallback) {
  if (lateral_xray != null || panorama != null) {
    //파일 등록처리
    var formData = new FormData()
    if (lateral_xray != null) {
      formData.append('lateral_xray', lateral_xray, lateral_xray.name)
      formData.append('lateral_xray_rot', lateral_xray_rot)
    }

    if (panorama != null) {
      formData.append('panorama', panorama, panorama.name)
      formData.append('panorama_rot', panorama_rot)
    }

    await $.ajax({
      url: '../service_file_upload.php',
      data: formData,
      enctype: 'multipart/form-data',
      type: 'post',
      contentType: false,
      processData: false,
      async: true /* @LUCAS 꼭 Async로 해야함. */,
      // dataType: 'html',
      success: function (data) {
        //  alert(data);
        // if (data.indexOf("true") != -1) {
        //     location.href = targetUrl;
        //   }
      },
      xhr: getXhrFunctionForUpload(uploadStatusCallback),
    })
  } else return
}

function deleteFile(type) {
  $.ajax({
    cache: false,
    url: '../service_file_delete.php',
    type: 'POST',
    data: { type: type },
    dataType: 'text',
    success: function (data) {
      // alert(data);
    }, // success
    error: function (xhr, status) {
      // alert(xhr + " : " + status);
    },
  })
}
