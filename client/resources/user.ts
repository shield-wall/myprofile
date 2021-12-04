import { Hydra, HydraCollection } from '~/resources/abstract.resource'
import { ResourceInterface } from '~/resources/contracts/resource.interface'
import { ResourceCollectionInterface } from '~/resources/contracts/resource.collection.interface'

export class User extends Hydra implements ResourceInterface {
  id: number|null = null
  firstName: string|null = null
  lastName: string|null = null
  email: string = ''
  role: string|null = null
  slug: string|null = null
  profileImage: string|null = null
  backgroundImage: string|null = null
  password: string|null = null
  confirmPassword: string|null = null
}

export class UserCollection extends HydraCollection implements ResourceCollectionInterface {
  'hydra:member': User[];
}
