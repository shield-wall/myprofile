import {Hydra, HydraCollection} from "~/resources/abstract.resource";
import {ResourceInterface} from "~/resources/contracts/resource.interface";
import {ResourceCollectionInterface} from "~/resources/contracts/resource.collection.interface";

export class UserCollection extends HydraCollection implements ResourceCollectionInterface
{
  "hydra:member": User[];
}

export class User extends Hydra implements ResourceInterface
{
  id: number|null
  firstName: string|null
  lastName: string|null
}
