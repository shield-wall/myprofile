import { DetailSectionInterface } from "../../../models/contracts/detail-section-interface";
import { sectionContent } from "./section-content";

export default function boxDetail(
	detailSection: DetailSectionInterface
): string {
	return `
    <div class="column">
        <div class="is-flex is-justify-content-space-between">
            <div>
                <strong>${detailSection.getTitle()}</strong> (${detailSection.getInstitution()})
            </div>
            <div>${detailSection.getTimePeriod()}</div>
        </div>
        <div class="mt-2">${sectionContent(detailSection)}</div>
    </div>`;
}
