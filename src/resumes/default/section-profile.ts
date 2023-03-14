import {ResumeInterface} from "../../models/resume";

export default function sectionProfile(resume: ResumeInterface) {
    let basic = resume.basic;

    return `
    <div class="hero is-fullheight">
        <div class="columns is-flex-direction-column">
            <div class="column">
                <div class="columns is-flex-direction-column is-align-items-center">
                    <div class="column">
                        <figure class="image is-128x128">
                            <img src="${basic.photoUrl}" class="is-rounded"  alt="profile image"/>
                        </figure>
                    </div>
    
                    <div class="column has-text-centered">
                        <div class="title is-3" id="name">
                            ${basic.firstName} ${basic.lastName}
                        </div>
                        <div class="subtitle is-6">
                            ${basic.position}
                        </div>
                    </div>
    
   
                    <div class="column">
                        <div class="tags">
                            ${resume.skills.map((skill) => `<div class="tag is-dark">${skill.title}</div>`)}
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="column">
                ${resume.simpleLists.map((simpleList) => {
                    return `
                        <div class="icon-text">
                              <span class="icon">
                                <i class="${simpleList.icon}"></i>
                              </span>
                              <span>${simpleList.title}</span>
                        </div>
                    `
                })}
            </div>
    
            <div class="column">
                <div class="content is-small">
                    <h2>
                        <i class="fas fa-graduation-cap"></i> Education
                    </h2>
                    ${resume.educations.map((education) => {
                        return `
                            <div>
                                <div class="is-size-6 has-text-weight-bold">${education.degree}</div>
                                <div>${education.institution}</div>
                                <div>
                                    ${education.timePeriod}
                                </div>
                            </div>
                            `
                    })}
                </div>
            </div>

            <div class="column">
                <div class="content is-small">
                    <h2>
                        <i class="fas fa-language"></i> Languages
                    </h2>
                    <div class="is-flex is-flex-direction-column">
                        ${basic.languages.map((language) => {
                            return `
                            <div class="my-2">
                                <div class="tags has-addons">
                                    <span class="tag">${language.title}</span>
                                    <span class="tag is-black">${language.level}</span>
                                </div>
                            </div>
                            `
                        })}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    `;
}