import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import 'ckeditor5/ckeditor5.css';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const messageEditor = document.querySelector('#message');

    if (messageEditor) {
        ClassicEditor
            .create(messageEditor, {
                licenseKey: 'GPL',
                toolbar: {
                    items: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'redo', 'undo' ],
                    shouldNotGroupWhenFull: false
                },

                // Add some Default Paragraph heading styles to select from
                //  Example: When a user selects "Heading 1" from the toolbar,
                //  the editor will format the selected text as an <h1> element,
                //  styled with the class ck-heading_heading1.
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },

                // Hide or Show the menu Bar at the top of the editor
                //  There is a tabbed menu bar available to use, however we will set this as false as we wont be using it
                menuBar: {
                    isVisible: false
                },

                placeholder: 'Enter your message here...',
            })
            .catch(error => {
                console.error(error);
            });
    }
});
