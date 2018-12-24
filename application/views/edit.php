<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Navya dynamic forms</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
		
		<!-- Custom styles for this template -->
    <link href="../../css/scrolling-nav.css" rel="stylesheet">

  <style>
    .addQuestion, .saveForm{
      cursor: pointer;
    }
    </style>
</head>

<body class="bg-dark">

    <!-- Navigation -->
    <div class="container mx-auto mt-5">
        <div class="row">
            <div class="col-lg-10 col-md-8 col-sm-12">
                <div class="card card-login">
                    <div class="card-header formTitle" contenteditable="true" id="<?php echo $Form[0]->Id; ?>">
                        <?php echo $Form[0]->Title; ?>
                    </div>
                    <form id="fmCustomForm">
                        <div class="list-group m-4 QuestionsList">
                            <div class="list-group-item card-body Question">
                                <div class="form-row">
                                    <div class="col-lg-9 col-md-12">
                                            <label for="inputPassword">Question</label>
                                            <input type="text" class="form-control inpQuestionTitle" name="inpQuestionTitle" 
                                            placeholder="Question">
                                        </div>
                                        <div class="col-lg-3 col-md-9">
                                                <label for="slctQuestionType">Type</label>
                                        <select class="form-control slctQuestionType" name="slctQuestionType">
                                            <option value="Paragraph">Paragraph</option>
                                            <option selected value="MultipleChoice">Multiple choice</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="Options">
                                    <div class="control-group mt-3" id="Choices">
                                        <div class="controls">
                                            <div class="entry input-group col-xs-3 mt-1">
                                                <input class="form-control" name="Choices[]" type="text" placeholder="Type something" />
                                                <span class="input-group-btn input-group-append">
                                                    <button class="btn btn-success btn-add" type="button">
														<i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-control form-check-input col-lg-6 col-md-12 isRequired" id="isRequired" type="checkbox">
                                            Required?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-2 mt-5">
                <ul class="list-group">
                    <li class="list-group-item active addQuestion">Add Question</li>
                    <li class="list-group-item saveForm">Save Form</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!-- Custom JavaScript for this theme -->
    <script src="../../js/main.js"></script>
    <script>
        var Questions = <?php echo json_encode($Questions); ?>;
        // console.log(Questions);
        var $QuestionsListGroup = $('.QuestionsList');
        var controlForm = $($QuestionsListGroup).find('.Question:first').clone();
        setForm(Questions);
        
    </script>
</body>

</html>