<?php include APP_DIR . 'views/templates/header.php'; ?>
<body>
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <div id="app" class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-12">
                <?php include APP_DIR . 'views/templates/sidebar1.php'; ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-12">
                <h2>Question Management</h2>

                <!-- Question Form -->
                <form id="question-form">
                    <div class="mb-3">
                        <label for="question_type" class="form-label">Question Type</label>
                        <select class="form-select" id="question_type" name="question_type" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="identification">Identification</option>
                            <option value="true_false">True/False</option>
                        </select>
                    </div>

                    <!-- Question Text -->
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
                    </div>

                    <!-- Dynamic Inputs Based on Question Type -->
                    <div id="dynamic-fields"></div>

                    <!-- Add Button -->
                    <button type="button" id="add-question-btn" class="btn btn-primary">Add Question</button>
                </form>

                <!-- Questions List -->
                <h3 class="mt-4">Questions List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Type</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="questions-list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        let questions = [];
        let editId = null; // Track the ID of the question being edited

        // Load questions from the database
        function loadQuestions() {
            $.ajax({
                type: 'GET',
                url: '/question/getQuestions',
                success: function(response) {
                    questions = JSON.parse(response).questions;
                    renderQuestions();
                },
                error: function() {
                    alert('Error loading questions.');
                }
            });
        }

        // Render questions in the list
        function renderQuestions() {
            $('#questions-list').empty();
            questions.forEach((q, index) => {
                const answers = q.options ? q.options.split(',').join(', ') : q.correct_answer || '';
                $('#questions-list').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${q.question_text}</td>
                        <td>${q.question_type}</td>
                        <td>${answers}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="${q.id}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${q.id}">Delete</button>
                        </td>
                    </tr>
                `);
            });
        }

        // Handle question type change
        $('#question_type').change(function() {
            const type = $(this).val();
            const dynamicFields = $('#dynamic-fields');
            dynamicFields.empty(); // Clear previous fields

            if (type === 'multiple_choice') {
                dynamicFields.append(`
                    <div class="mb-3">
                        <label for="choices" class="form-label">Choices (comma-separated)</label>
                        <input type="text" class="form-control" id="choices" name="choices" required>
                    </div>
                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Correct Answer</label>
                        <input type="text" class="form-control" id="correct_answer" name="correct_answer" required>
                    </div>
                `);
            } else if (type === 'identification') {
                dynamicFields.append(`
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <input type="text" class="form-control" id="answer" name="answer" required>
                    </div>
                `);
            } else if (type === 'true_false') {
                dynamicFields.append(`
                    <div class="mb-3">
                        <label class="form-label">Answer</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="correct_answer" id="true" value="True" required>
                            <label class="form-check-label" for="true">True</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="correct_answer" id="false" value="False" required>
                            <label class="form-check-label" for="false">False</label>
                        </div>
                    </div>
                `);
            }
        });

        // Add or edit a question
        $('#add-question-btn').click(function() {
            const type = $('#question_type').val();
            const questionText = $('#question').val();
            const dynamicData = $('#dynamic-fields').serializeArray();
            const dynamicObject = {};

            dynamicData.forEach(field => dynamicObject[field.name] = field.value);

            const question = { 
                question_type: type, 
                question_text: questionText,
                ...dynamicObject 
            };

            const url = editId !== null ? '/question/updateQuestion' : '/question/saveQuestion';
            const requestData = editId !== null ? { ...question, id: editId } : question;

            // Send data to the controller
            $.ajax({
                type: 'POST',
                url: '/question/saveQuestion', // This will match the route in the router
                data: requestData,  // Send the question data to the controller
                success: function(response) {
                    if (response.success) {
                        loadQuestions(); // Reload questions list after successful save
                        $('#question-form')[0].reset();
                        $('#dynamic-fields').empty();
                        editId = null;  // Reset edit mode
                    } else {
                        alert('Error saving question: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error saving question: ' + xhr.responseText);
                }
            });
        });

        // Edit question
        $(document).on('click', '.edit-btn', function() {
            const questionId = $(this).data('id');
            const question = questions.find(q => q.id === questionId);
            editId = questionId;
            $('#question').val(question.question_text);
            $('#question_type').val(question.question_type).change(); // Trigger change to show relevant inputs

            // Populate dynamic fields based on question type
            if (question.question_type === 'multiple_choice') {
                $('#choices').val(question.options);
                $('#correct_answer').val(question.correct_answer);
            } else if (question.question_type === 'identification') {
                $('#answer').val(question.answer);
            } else if (question.question_type === 'true_false') {
                $(`input[name="correct_answer"][value="${question.correct_answer}"]`).prop('checked', true);
            }
        });

        // Delete question
        $(document).on('click', '.delete-btn', function() {
            const questionId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/question/deleteQuestion',
                data: { id: questionId },
                success: function() {
                    loadQuestions();
                },
                error: function() {
                    alert('Error deleting question.');
                }
            });
        });

        // Initial load
        loadQuestions();
    });
</script>

</body>
</html>
