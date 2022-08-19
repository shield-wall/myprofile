import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ['input', 'preview'];

    connect(event) {
        console.log(this.element.dataset.colorId);
        console.log(JSON.parse(this.element.dataset.curriculumImageIdValue)[2][0]);
        this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/curriculum_controller.js';
    }
}
