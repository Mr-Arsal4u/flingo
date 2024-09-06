                                   <<<<<<<<=====Flingo=====>>>>>>>
Flingo is a chat application, similar to WhatsApp, designed to facilitate seamless communication between users. Built using Laravel, Flingo offers a simple and user-friendly interface with three main sections for managing conversations, browsing users, and sending bulk emails. It provides an easy way to start chats and stay connected with other users in the system.

                                  <<<<<<<=====Features=====>>>>>>>
Conversation Section: This section displays users with whom you’ve had previous conversations, making it easy to continue chatting with them.
All Users Section: Here, you can browse all users available in the system.
Send Bulk Emails: In the third section, you have the ability to send emails to all users in the database.

                                   <<<<<<<=====Getting Started=====>>>>>>>
Clone the repository and navigate to the project directory.
Run composer install to install the dependencies.
Set up your .env file to configure your database and mail settings.
Run the following command to migrate the database and seed it with factory users:
php artisan migrate --seed

                                   <<<<<<<=====Branches=====>>>>>>>
master branch: Contains the core Flingo application with the chat and email functionality.
flingo/webhooks branch: This branch contains the same setup but includes webhooks for additional functionality.
Flingo provides a clean Laravel architecture, allowing you to easily extend or customize it as needed. Whether you're chatting with users or managing notifications via webhooks, Flingo offers a great starting point for a WhatsApp-like application.

