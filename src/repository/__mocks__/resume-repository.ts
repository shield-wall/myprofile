import {ResumeInterface} from "../../models/resume";

export class ResumeRepository
{
    findCurrentResume(): ResumeInterface
    {
        return {
            basic: {
                photoUrl: 'https://avatars.githubusercontent.com/u/6358755?v=4',
                position: 'Senior Software engineer',
                firstName: 'Erison',
                lastName: 'Silva',
                languages: [
                    {title: 'Portuguese', level: 'Native'}
                ]
            },
            skills: [
                {title: 'Typescript'},
                {title: 'Typescript'},
                {title: 'Typescript'},
                {title: 'Typescript'},
            ],
            educations: [
                {
                    degree: 'ADS',
                    description: 'blha blha bla',
                    institution: 'Haaaa',
                    timePeriod: '2012 - 2013',
                    website: null,
                }
            ],
            simpleLists: [],
        };
    }
}