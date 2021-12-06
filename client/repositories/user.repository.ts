import { AbstractRepository } from '~/repositories/abstract.repository'
import { UserCollection } from '~/resources/user'
import { ResourceCollectionInterface } from '~/resources/contracts/resource.collection.interface'

export class UserRepository extends AbstractRepository {
  protected resource (): string {
    return '/users'
  }

  protected collectionInstance (): ResourceCollectionInterface {
    return new UserCollection()
  }
}
