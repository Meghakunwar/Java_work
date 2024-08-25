document.getElementById('add-student-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const studentId = document.getElementById('student-id').value;
    const name = document.getElementById('name').value;
    const department = document.getElementById('department').value;
    const thesisTitle = document.getElementById('thesis-title').value;

    // Create a new list item
    const li = document.createElement('li');
    li.textContent = `ID: ${studentId}, Name: ${name}, Department: ${department}, Thesis Title: ${thesisTitle}`;

    // Append to list
    document.getElementById('students-list').appendChild(li);

    // Clear form
    document.getElementById('add-student-form').reset();
});
