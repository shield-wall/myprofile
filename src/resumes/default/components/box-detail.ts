import {DetailSectionInterface} from "../../../models/contracts/detail-section-interface";
import {sectionContent} from "./section-content";
import {Icons} from "../../../components/icons";

export default function boxDetail(
    detailSection: DetailSectionInterface
): string {
    let timelineIcon = `<div class="is-size-5 ml-1">${Icons['circle']}</div>`;

    if (detailSection.getPhotoUrl())
        timelineIcon = `
            <a href="${detailSection.getWebsite()}">
                <figure class="image is-24x24 m-0 has-background-white">
                  <img class="is-rounded" src="${detailSection.getPhotoUrl()}">
                </figure>
            </a>
            `;

    return `
    <div class="column timeline-item">
        <div class="timeline-icon">
            ${timelineIcon}
        </div>
        <div class="timeline-content">
            <div class="">
                <div class="is-italic">
                    ${detailSection.getTimePeriod()}
                    
                </div>
                <div class="is-text has-text-weight-bold is-size-5">
                    ${detailSection.getTitle()}
                    <div class="tag">${detailSection.getInstitution()}</div>
                </div>
            </div>
            <div class="mt-2">${sectionContent(detailSection)}</div>
        </div>
    </div>`;
}
