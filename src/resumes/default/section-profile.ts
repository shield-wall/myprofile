import {Resume} from "../../models/resume";
import title from "./components/title";
import {Icons} from "../../components/icons";
import {Section} from "../../models/section";

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
    
            <div class="column">
                ${resume.getSimpleLists().map((simpleList) => {
                    return `
                        <div class="icon-text">
                              <span class="icon">
                                <i class="${simpleList.getIcon()}"></i>
                              </span>
                              <span>${simpleList.getTitle()}</span>
                        </div>
                    `
                }).join('')}
            </div>
    
            <div class="column">
                <div class="content">
                    ${title(new Section('Education', Icons['education']))}
                    ${resume.getEducations().map((education) => {
                        return `
                            <div class="mb-2">
                                <div class="is-size-6 has-text-weight-bold">${education.getDegree()}</div>
                                <div>${education.getInstitution()}</div>
                                <div>
                                    ${education.getTimePeriod()}
                                </div>
                            </div>
                            `
                    }).join('')}
                </div>
            </div>

            <div class="column">
                <div class="content">
                    ${title(new Section('Languages', Icons['language']))}
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