<?php

class QuestionController extends Controller
{
    private $questionModel;

    public function __construct()
    {
        parent::__construct();
        $this->questionModel = new QuestionModel();
    }

    // Render question management page
    public function renderQuestionManagement()
    {
        $this->call->view('question-management'); 
    }

    // Get all questions
    public function getQuestions()
    {
        $questions = $this->questionModel->getAllQuestions();
        echo json_encode(['questions' => $questions]);
    }

    // Save a new question
    public function saveQuestion()
    {
        // Check if required POST data exists
        if (empty($_POST['question_type']) || empty($_POST['question'])) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
            return;
        }
    
        // Prepare the data for insertion
        $data = [
            'question_type' => $_POST['question_type'],
            'question_text' => $_POST['question'],
            'options' => isset($_POST['choices']) ? $_POST['choices'] : null,
            'correct_answer' => isset($_POST['correct_answer']) ? $_POST['correct_answer'] : null,
            'answer' => isset($_POST['answer']) ? $_POST['answer'] : null
        ];
    
        // Call the model to save the data
        if ($this->questionModel->saveQuestion($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save question.']);
        }
    }

    // Update an existing question
    public function updateQuestion()
    {
        $id = $_POST['id'];
        $data = [
            'question_type' => $_POST['question_type'],
            'question_text' => $_POST['question'],
            'options' => isset($_POST['choices']) ? $_POST['choices'] : null,
            'correct_answer' => isset($_POST['correct_answer']) ? $_POST['correct_answer'] : null,
            'answer' => isset($_POST['answer']) ? $_POST['answer'] : null
        ];

        if ($this->questionModel->updateQuestion($id, $data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    // Delete a question
    public function deleteQuestion()
    {
        $id = $_POST['id'];

        if ($this->questionModel->deleteQuestion($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}
?>
