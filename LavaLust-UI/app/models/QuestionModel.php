<?php

class QuestionModel extends Model
{
    protected $table = 'questions';

    // Fetch all questions from the database
    public function getAllQuestions()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Save a new question to the database
    public function saveQuestion(array $data)
    {
        // Check if all required fields are present
        if (!isset($data['question_type']) || !isset($data['question_text'])) {
            return false; // Return false if required data is missing
        }

        return $this->insert($data);
    }

    // Insert data into the table
    public function insert($data)
    {
        // Sanitize input data
        $columns = implode(",", array_keys($data));
        $placeholders = implode(",", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

        // Prepare and execute the SQL statement
        $stmt = $this->db->prepare($sql);

        // Bind parameters dynamically
        return $stmt->execute(array_values($data));
    }

    // Update an existing question
    public function updateQuestion($id, $data)
    {
        // Check if ID and data are valid
        if (empty($id) || empty($data)) {
            return false;
        }

        $setClause = [];
        foreach ($data as $key => $value) {
            $setClause[] = "$key = ?";
        }

        $setClause = implode(",", $setClause);
        $sql = "UPDATE {$this->table} SET $setClause WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(array_merge(array_values($data), [$id]));
    }

    // Delete data from the table
    public function delete($id)
    {
        if (empty($id)) {
            return false;
        }

        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
