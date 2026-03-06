# TaskPlannerM

TaskPlannerM is a task management web application built with Laravel that allows users to organize work using Task Managers, Tasks, Tags, and Task Entries.  
The goal of the project is to provide a simple way to structure daily tasks and track progress.

The application follows the Laravel MVC architecture and uses Eloquent ORM for database management.

---

# Features

## User Authentication
- User registration and login
- Email verification support
- Secure session handling

## Task Managers
Users can create Task Managers to group related tasks.

Example:

Study  
Work  
Gym  
Personal  

Each Task Manager belongs to a specific user.

---

## Tasks
Each Task Manager can contain multiple tasks.

Example:

Task Manager: Study

- Mathematics  
- Programming  
- Physics  

Tasks include:

- name
- daily_target
- unit_type
- is_active

---

## Tags
Tasks can have multiple tags for categorization.

Example:

Important  
Urgent  
Exam  
Practice  

Each tag contains:

- name
- color

Tasks and Tags have a many-to-many relationship.

---

## Task Entries
Users can record daily progress for tasks.

Example:

Task: Programming  
Entry: 3 hours completed  
Date: 2026-03-05  

Task Entries store progress information for each task.

---

# Database Relationships

User → TaskManagers (One-to-Many)

User → Tags (One-to-Many)

TaskManager → Tasks (One-to-Many)

Task → Tags (Many-to-Many)

Task → TaskEntries (One-to-Many)

---

# Routes

Main routes used in the application:

/home  
/office  
/office/{task_manager}  
/office/{task_manager}/{task}
/settings  
/news  

Explanation:

| Route | Description |
|------|-------------|
| /home | User dashboard |
| /office | List of task managers |
| /office/{task_manager} | Tasks inside a specific task manager |
| /office/{task_manager}/{task} | Task details |
| /settings | User settings |
| /news | Application news |

---

# Database Tables

users  
task_managers  
tasks  
tags  
task_tag  
task_entries  
sessions  
password_reset_tokens  
and others

---

# Project Purpose

This project was created as a learning project to practice:

- Laravel framework
- MVC architecture
- database design
- authentication systems
- CRUD operations
- RESTful routing
- web application development

---

# Future Improvements

Planned features include:

- task progress analytics
- statistics and charts
- reminders
- notifications
- improved user interface
- mobile responsive design
- better logic and functionality

---
