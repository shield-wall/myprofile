import {User} from "../../contracts/user";

export class userRepository
{
    findCurrentUser(): User
    {
        let user: User = {
            firstName: 'Erison',
            lastName: 'Silva',
        };

        return user;
    }
}