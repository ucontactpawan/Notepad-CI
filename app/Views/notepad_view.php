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
      justify-content: left;
      align-items: left;
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
      width: 98%;
      height: 700px;
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

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-toggle {
      background-color: #f4f4f4;
      border: 1px solid #ddd;
      padding: 5px 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .arrow {
      margin-left: 5px;
      font-size: 12px;
      color: #555;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      width: 150px;
    }

    .dropdown-menu button {
      display: flex;
      align-items: center;
      width: 100%;
      padding: 5px 10px;
      border: none;
      background: none;
      text-align: left;
      cursor: pointer;
    }

    .dropdown-menu button:hover {
      background-color: #f4f4f4;
    }

    .icon {
      margin-right: 8px;
      font-size: 16px;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }
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

    function openNewDocument() {
      console.log("Opening new document");
      const confirmNew = confirm("Are you sure you want to open a new document");
      if (confirmNew) {
        document.querySelector('textarea').value = '';
        updateWordCount();
      }
    }

    function performEdit(action) {
      const textarea = document.querySelector('textarea');
      textarea.focus();

      switch (action) {
        case 'undo':
          document.execCommand('undo');
          break;
        case 'redo':
          document.execCommand('redo');
          break;
        case 'cut':
          document.execCommand('cut');
          break;
        case 'copy':
          document.execCommand('copy');
          break;
        case 'paste':
          document.execCommand('paste');
          break;
        default:
          alert('invalid action');
      }

    }
  </script>
</head>

<body>
  <div class="toolbar">

    <div class="dropdown">
      <button class="dropdown-toggle">File
        <span class="arrow">▼</span>
      </button>
      <div class="dropdown-menu">
        <button onclick="saveFile()">
          <span class="icon">💾</span> Save
        </button>
        <button onclick="openNewDocument()">
          <span class="icon">📄</span> New Document
        </button>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropdown-toggle" onclick="toggleDropdown()">
        Edit<span class="arrow">▼</span>
      </button>
      <div class="dropdown-menu" id="editDropdown">
        <button onclick="performEdit('undo')">
          <span class="icon">↺</span> Undo
        </button>
        <button onclick="performEdit('redo')">
          <span class="icon">↻</span> Redo
        </button>
        <button onclick="performEdit('cut')">
          <span class="icon">✂</span>Cut
        </button>
        <button onclick="performEdit('copy')">
          <span class="icon">📋</span>Copy
        </button>
        <button onclick="performEdit('paste')">
          <span class="icon">📥</span>Paste
        </button>
      </div>
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
