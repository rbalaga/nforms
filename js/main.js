function addMultipleChoice(parent) {
    $(parent).html(
        '<div class="control-group mt-3" id="fields">' +
        '<div class="controls">' +
        '<div class="entry input-group col-xs-3">' +
        '<input class="form-control" name="Choices[]" type="text" placeholder="Type something" />' +
        '<span class="input-group-btn input-group-append">' +
        '<button class="btn btn-success btn-add" type="button">' +
        '<span class="fa fa-plus"></span>' +
        '</button>' +
        '</span>' +
        '</div>' +
        '</div>' +
        '</div>'
    );
}

function addParagraph(parent) {

    $(parent).html(
        $('<textarea>', {
            class: 'form-control col-12 mt-3',
            readonly: 'true',
            placeholder: 'User answer',
        })
    );

}


$QuestionsListGroup = $('.QuestionsList');
var controlForm = $($QuestionsListGroup).find('.Question:first').clone();

$(function () {

    $(document).on('change', '.slctQuestionType', function (e) {
        $relatedOptionsElement = $(this).closest('.Question').find('.Options');
        e.preventDefault();
        switch ($(this).val()) {
            case 'MultipleChoice':
                addMultipleChoice($relatedOptionsElement);
                break;
            case 'Paragraph':
                addParagraph($relatedOptionsElement);
                break;
            default:
                addParagraph($relatedOptionsElement);
                break;
        }

    });

    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        $relatedOptionsElement = $(this).closest('.Question');
        var controlForm = $($relatedOptionsElement).find('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    }).on('click', '.btn-remove', function (e) {
        $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });

    $(document).on('click', '.addQuestion', function (e) {
        e.preventDefault();
        // currentEntry = $(this).parents('.entry:first'),
        $(controlForm).appendTo($QuestionsListGroup);
        controlForm = controlForm.clone();
    });

    $(document).on('click', '.saveForm', function (e) {
        e.preventDefault();
        var finalQuestions = $('.QuestionsList .Question');
        var FormObj = new Object();
        FormObj.FormTitle = $('.formTitle').html();
        FormObj.FormId = $('.formTitle').attr('id');
        FormObj.Questions = Array();
        finalQuestions.each(function (Idx, Question) {
            var QuestionObj = new Object();
            QuestionObj.QuestionTitle = $(Question).find('.inpQuestionTitle').val();
            QuestionObj.QuestionType = $(Question).find('.slctQuestionType').val();
            QuestionObj.isRequired = $(Question).find('.isRequired')[0].checked;            
            QuestionObj.Options = Array();
            if (QuestionObj.QuestionType == "MultipleChoice") {
                $(Question).find("input[name*='Choices']").each(function () {
                    if ($(this).val().length > 0) {
                        QuestionObj.Options.push($(this).val());                        
                    }
                    // alert(QuestionTitle + '=' +  $(this).val());
                });
            }
            if (QuestionObj.QuestionTitle.length > 0) {
                FormObj.Questions.push(QuestionObj);                
            }
        });

        postToServer(FormObj);

    });

});


function postToServer(formData) {
    console.log(formData);
    $.ajax({
        type: 'POST',
        url: '../../api/update',
        dataType: 'json',
        data:{
            FORM : formData,
        },
        success: function (response) {
            alert('Your form saved successfully');
        },
        error: function (error) {
            alert(JSON.stringify(error));
        }
    });
}


function getFormDetails(formid) {
    
    $.ajax({
        type: "GET",
        url : "../../api/form/" + formid,
        success: function (formData) {
            $form = $('.formTitle');
            $QuestionsList = $('.QuestionsList'); 
            $form.html(formData.Form[0].Title);
            $form.attr('id', formData.Form[0].Id);
            
            $Questions = formData.Questions;
            $.each($Questions, function (Idx, Question) {
                if ($('#' + Question.QuestionId).length > 0) {
                    addOption(Question);
                }else{
                    $QuestionsList.append('<div class="list-group-item card-body Question" QType="'+ Question.QType +'" id="'+ Question.QuestionId +'">' + 
                        '<div class="entry input-group col-xs-3 mt-1">' + 
                            '<fieldset class="form-group">' + 
                                '<legend>'+ Question.Question +'</legend>' + 
                            '</fieldset>' + 
                        '</div>' + 
                    '</div>');
                    addOption(Question);
                }

            });            
        },
        error: function (errData) {
            console.log(JSON.stringify(errData));
        }
    });

}

function addOption(Question) {
    
    $Option = "<span></span>";
    $IsRequired = Question.IsRequired == "1" ? "required" : "";
    if (Question.QType == "1") { //Multiple choice questions
        $Option = '<div class="form-check">' + 
            '<label class="form-check-label">' + 
                '<input type="radio" class="form-check-input" '+ $IsRequired +' name="Question'+ Question.QuestionId +'" id="Question'+ Question.QuestionId +'" value="'+ Question.QOption +'">' + 
                    Question.QOption + 
            '</label>' + 
        '</div>';
    }else{
        $Option = '<div class="form-check">'+
            '<label class="form-check-label">'+
                '<textarea class="form-control" '+ $IsRequired +' id="Question'+ Question.QuestionId +'" rows=2></textarea>'+
            '</label>'+
        '</div>';
    }
    $('#' + Question.QuestionId + ' fieldset').append($Option);
}

$(document).on('click', '.saveResponse', function () {
    saveResponse();
})

function saveResponse() {
    $formId = $('.formTitle').attr('id').trim();
    var $Response;
    $FormQuestionsList = $('.QuestionsList .Question');
    $QuestionResponse = Array();
    $isResponseCorrect = true;
    $.each($FormQuestionsList, function (Idx, Question) {
        $QuestionId = $(Question).attr('id');
        if ($(Question).attr('QType') == '1') {
            $QResponse = $(Question).find('#Question' + $QuestionId + ':checked').val();            
        }else{
            $QResponse = $(Question).find('#Question' + $QuestionId).val();
            $QResponse = $QResponse == "" ? undefined : $QResponse;
        }
        if ($(Question).find('#Question' + $QuestionId).attr('required') != undefined &&
            $QResponse == undefined
        ) {
            $isResponseCorrect = false;
        }else{
            $QuestionResponse.push({
                QuestionId : $QuestionId ? $QuestionId : null,
                Response: $QResponse ? $QResponse : null
            });
        }
    });
    if ($isResponseCorrect) {
        $Response = {
            FormId : $formId,
            Response : $QuestionResponse
        }
        $.ajax({
            type: 'POST',
            url: '../../api/save',
            dataType: 'json',
            data: { Response : $Response },
            success: function (Response) {
                alert('Response saved successfully');
            },
            error: function (errData) {
                alert(JSON.stringify(errData));            
            }
        });
    }else{
        alert('Please provide your response to required requestions');
    }
}

function setForm(mQuestions) {
    $QuestionsListGroup.empty();
    if (mQuestions == null) {
        var QuestionForm = $(controlForm).clone();
        $(QuestionForm).appendTo($QuestionsListGroup);
    }
    $.each(mQuestions, function(Idx, Question){

        if($($QuestionsListGroup).find('.Question#' + Question.QuestionId).length > 0){
            if (Question.QType == "1") {
                $input = $($QuestionsListGroup).find('.Question#' + Question.QuestionId + ' .entry:last').clone();
                $($input).find('.btn-add').trigger('click');
                $($input).find('input').val(Question.QOption);
                $($QuestionsListGroup).find('.Question#' + Question.QuestionId + ' .controls').append($input);
            }
        }else{
        
            var QuestionForm = $(controlForm).clone();
            $(QuestionForm).appendTo($QuestionsListGroup);
            $(QuestionForm).find('.inpQuestionTitle').val(Question.Question);
            $(QuestionForm).attr('id', Question.QuestionId);
            if(Question.QType == "1"){
                $(QuestionForm).find('.slctQuestionType').val( "MultipleChoice");
                $input = $($QuestionsListGroup).find('.Question#' + Question.QuestionId + ' .entry:last');
                $($input).find('input').val(Question.QOption);
            }else{
                $(QuestionForm).find('.slctQuestionType').val( "Paragraph");
                addParagraph($(QuestionForm).find('.Options'));
            }
            if (Question.IsRequired == "1") {
                $(QuestionForm).find('.isRequired').attr('checked','checked');
            }
        }
    });
}


function getFormsList() {
    $.ajax({
        type: 'GET',
        url: './api/forms',
        contentType: 'text/json',
        success: function (formsList) {
            if (formsList.length > 0 ) {
                console.log(formsList);
                $FormsListGroup = $('.formsList');
                for (let formIdx = 0; formIdx < formsList.length; formIdx++) {
                    const Form = formsList[formIdx];
                    $FormsListGroup.append(
                    '<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">' +
                        '<div class="card h-100">' +
                        '<a target="./form/view/'+ Form.Id +'" href="./form/view/'+ Form.Id +'"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>' +
                        '<div class="card-body">' +
                            '<h4 class="card-title">' +
                            '<a target="./form/view/'+ Form.Id +'" href="./form/view/'+ Form.Id +'">'+ Form.Title +'</a>' +
                            '</h4>' +
                            '<ul class="list-group">' +
                                '<li class="list-group-item pt-1 pb-1">Questions : '+ Form.QuestionsCnt +'</li>' +
                                '<li class="list-group-item pt-1 pb-1">'+
                                    '<a target="./form/edit/'+ Form.Id +'" href="./form/edit/'+ Form.Id +'">Edit form</a>' + 
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                        '</div>' +
                    '</div>' );    
                }
            }
        },
        error: function (errData) {
            console.log(errData);
        }
    })
}