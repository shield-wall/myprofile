import { DetailSectionInterface } from "../../../models/contracts/detail-section-interface";

export function sectionShortDetail(
	shortDetail: DetailSectionInterface
): string {
	return `
     <div class="mb-2">
        <div class="is-size-6 has-text-weight-bold">${shortDetail.getTitle()}</div>
        <div>${shortDetail.getInstitution()}</div>
        <div>
            ${shortDetail.getTimePeriod()}
        </div>
    </div>
    `;
}
