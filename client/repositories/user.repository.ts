import {AbstractRepository} from "~/repositories/abstract.repository";
import {UserCollection} from "~/resources/user";
import {ResourceCollectionInterface} from "~/resources/contracts/resource.collection.interface";

export class UserRepository extends AbstractRepository
{
  resource(): string
  {
    return "/users";
  }

  collectionInstance(): ResourceCollectionInterface {
    return new UserCollection();
  }
}
