import {SkillInterface} from "./skill";
import {SimpleListInterface} from "./simple-list";
import {EducationInterface} from "./education";
import {BasicInterface} from "./basic";

export interface ResumeInterface
{
    basic: BasicInterface
    skills: SkillInterface[]
    simpleLists: SimpleListInterface[]
    educations: EducationInterface[]
}