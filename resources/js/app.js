import './bootstrap';
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import {
    ClassicEditor,
    AutoLink,
    Autosave,
    Bold,
    Essentials,
    FontColor,
    FontSize,
    Heading,
    Italic,
    Link,
    Paragraph,
    SpecialCharacters
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const messageEditor = document.querySelector('#message');

    if (messageEditor) {
        ClassicEditor
            .create(messageEditor, {
                licenseKey: 'GPL',
                toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontColor', '|',
                        'bold', 'italic', '|',
                        'link', '|',
                        'redo', 'undo' ],
                    shouldNotGroupWhenFull: false
                },

                plugins: [
                    AutoLink,
                    Autosave,
                    Bold,
                    Essentials,
                    FontColor,
                    FontSize,
                    Heading,
                    Italic,
                    Link,
                    Paragraph,
                    SpecialCharacters
                ],

                // Add some Default Font Sizes to select from
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },

                // Add some Default Paragraph heading Sizes to select from
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },

                // Add Some default colours to select in the editor (Other then the colour Picker)
                fontColor: {
                    colors: [
                        {
                            color: 'rgb(0, 0, 0)',
                            label: 'Black'
                        },
                        {
                            color: 'rgb(230, 0, 0)',
                            label: 'Red'
                        },
                        {
                            color: 'rgb(0, 112, 0)',
                            label: 'Green'
                        },
                        {
                            color: 'rgb(0, 0, 255)',
                            label: 'Blue'
                        },
                        {
                            color: 'rgb(255, 165, 0)',
                            label: 'Orange'
                        },
                        {
                            color: 'rgb(128, 0, 128)',
                            label: 'Purple'
                        }
                    ]
                },

                // Hide or Show the menu Bar at the top of the editor
                menuBar: {
                    isVisible: false
                },

                placeholder: 'Enter your message...',
            })
            .catch(error => {
                console.error(error);
            });
    }
});
