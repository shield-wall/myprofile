import {Resume} from "../../models/resume";
import {sections} from "./components/sections";

export default function sectionProfile(resume: Resume) {
    let basic = resume.getBasic();

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
    
   
                    <div class="column">
                        <div class="tags">
                            ${
                                resume.getSkills()
                                    .map((skill) => `<div class="tag is-dark">${skill}</div>`)
                                    .join('')
                            }
                        </div>
                    </div>
                </div>
            </div>
    
            
            ${sections(resume.getSections())}

            <div class="column">
                <div class="content">
                    <div class="is-flex is-flex-direction-column">
                        ${basic.getLanguages().map((language) => {
                            return `
                            <div class="my-2">
                                <div class="tags has-addons">
                                    <span class="tag">${language.getTitle()}</span>
                                    <span class="tag is-black">${language.getLevel()}</span>
                                </div>
                            </div>
                            `
                        }).join('')}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    `;
}