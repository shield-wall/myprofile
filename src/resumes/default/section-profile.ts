import { Resume } from "../../models/resume";
import { sections } from "./components/sections";

export default function sectionProfile(resume: Resume) {
	const basic = resume.getBasic();

	return `
    <div class="hero is-fullheight">
        <div class="columns is-flex-direction-column">
        
            <div class="column">
                <div class="columns is-flex-direction-column is-align-items-center">
                    <div class="column">
                        <figure class="image is-128x128">
                            <img src="${basic.getPhotoUrl()}" class="is-rounded"  alt="profile image"/>
                        </figure>
                    </div>
    
                    <div class="column has-text-centered">
                        <div class="title is-3" id="name">
                            ${basic.getFirstName()} ${basic.getLastName()}
                        </div>
                        <div class="subtitle is-6">
                            ${basic.getPosition()}
                        </div>
                    </div>
                </div>
            </div>
    
            ${sections(resume.getSectionsTwo())} 
        </div>
    </div>
    `;
}
