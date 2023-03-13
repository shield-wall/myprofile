import resume from "./resumes/resume";
import defaultTemplate from "./resumes/default/default-template";
import {userRepository} from "./repository/__mocks__/user-repository";
// TODO add variable to import from data
//  import {userRepository} from "./repository/user-repository";

let repository = new userRepository();
let template = new defaultTemplate(repository.findCurrentUser());

resume(document.querySelector<HTMLDivElement>('#app')!, template);
