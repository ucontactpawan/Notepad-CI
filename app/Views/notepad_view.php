<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notepad</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: linear-gradient(to bottom, #a8d0e6, #f8f9fa);
    }

    .toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #f4f4f4;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
    }

    .toolbar select,
    .toolbar button {
      margin: 0 5px;
      padding: 5px 10px;
      font-size: 14px;
    }

    .notepad-container {
      padding: 20px;
    }

    textarea {
      width: 100%;
      height: 400px;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
      font-family: Arial, Helvetica, sans-serif;
      resize: none;
    }

    .word-count {
      margin-top: 10px;
      font-size: 14px;
      color: #555;
    }

    /* table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f4f4f4;
    } */
  </style>
  <script>
    function changeFontFamily(font) {
      document.querySelector('textarea').style.fontFamily = font;
    }

    function changeFontSize(size) {
      document.querySelector('textarea').style.fontSize = size + 'px';
    }

    function updateWordCount() {
      const content = document.querySelector('textarea').value.trim();
      const wordCount = content.length > 0 ? content.split(/\s+/).filter(word => word !== '').length : 0;
      document.getElementById('wordCount').textContent = `Words: ${wordCount}`;
    }

    function saveFile() {
      const content = document.querySelector('textarea').value.trim();
      if (content === '') {
        alert('The note is empty. Please write something before saving.');
        return;
      }

      const blob = new Blob([content], {
        type: 'text/plain'
      });
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = 'note.txt';
      link.click();
    }
  </script>
</head>

<body>
  <div class="toolbar">
    <div>
      <button onclick="saveFile()">File</button>
      <button onclick="alert('Edit options coming soon!')">Edit</button>
      <button onclick="alert('View options coming soon!')">View</button>
      <button onclick="alert('Help options coming soon!')">Help</button>
    </div>
    <div>
      <select onchange="changeFontFamily(this.value)">
        <option value="Arial">Arial</option>
        <option value="Courier New">Courier New</option>
        <option value="Georgia">Georgia</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Verdana">Verdana</option>
      </select>
      <select onchange="changeFontSize(this.value)">
        <option value="12">12px</option>
        <option value="14">14px</option>
        <option value="16" selected>16px</option>
        <option value="18">18px</option>
        <option value="20">20px</option>
      </select>
      <button onclick="document.querySelector('textarea').requestFullscreen()">Full Screen</button>
    </div>
  </div>

  <div class="notepad-container">
    <textarea oninput="updateWordCount()" placeholder="Write your note here..."></textarea>
    <div class="word-count" id="wordCount">Words: 0</div>
  </div>
</body>

</html>
