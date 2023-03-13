import fs from 'fs'
import YAML from 'yaml'
import {User} from "../contracts/user";

export class userRepository
{
    findCurrentUser(): User
    {
        const file = fs.readFileSync('../data/user.yaml', 'utf8')
        return YAML.parse(file)
    }
}