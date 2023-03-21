import {Section} from "../../../models/section";
import {SimpleList} from "../../../models/simple-list";
import {Education} from "../../../models/education";
import {sectionSimpleList} from "./section-simple-list";
import title from "./title";
import {Tag} from "../../../models/tag";
import {sectionTag} from "./section-tag";
import {Content} from "../../../models/content";
import {sectionContent} from "./section-content";
import boxDetail from "./box-detail";
import {Experience} from "../../../models/experience";
import {Certification} from "../../../models/certification";
import sectionCertification from "./section-certification";
import {sectionEducations} from "./section-educations";

export function sections(sections: Section[]): string {
    let content = '';
    sections.forEach((section: Section) => {
        content += `<div class="column">
                        <div class="mb-1">
                            ${title(section)} 
                        </div>
                        ${_section(section)}
                </div>`;
    });

    return content;
}

function _section(section: Section) {
    let content = '';
    section.getChildren().forEach((item: SimpleList
        | Education
        | Experience
        | Certification
        | Tag
        | Content
    ) => {
        if (item instanceof SimpleList)
            content += `<div>${sectionSimpleList(item)}</div>`;

        if (item instanceof Education)
            content += sectionEducations(item);

        if (item instanceof Experience)
            content += `<div>${boxDetail(item)}</div>`

        if (item instanceof Content)
            content += `<div>${sectionContent(item)}</div>`
    })

    content += _sectionTag(section);
    content += _sectionCertification(section);

    return content;
}

// TODO see other solution for this, because we are going into the list multiple times.
//      The reason for this function is, I want to put tags into the "div tags"
function _sectionTag(section: Section): string {
    let content = '';
    section.getChildren().forEach((item) => {
        if (item instanceof Tag)
            content += sectionTag(item)
    })

    return `<div class="tags">${content}</div>`;
}

// TODO see other solution for this, because we are going into the list multiple times.
//      The reason for this function is, I want to put tags into the "div columns is-gapless is-multiline"
function _sectionCertification(section: Section): string {
    let content = '';
    section.getChildren().forEach((item) => {
        if (item instanceof Certification)
            content += sectionCertification(item)
    })

    return `<div class="columns is-gapless is-multiline">${content}</div>`;
}
