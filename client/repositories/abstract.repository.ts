import { NuxtAxiosInstance } from '#app'
import { ResourceCollectionInterface } from '~/resources/contracts/resource.collection.interface'
import { UserRepository } from '~/repositories/user.repository'
// import { ResourceInterface } from '~/resources/contracts/resource.interface'

export abstract class AbstractRepository {
  private axios: NuxtAxiosInstance;

  constructor ($axios: NuxtAxiosInstance) {
    this.axios = $axios
  }

  public all (): Promise<ResourceCollectionInterface> {
    return this
      .axios
      .get(this.resource())
      .then((response: any) => response.data)
      .then((json: any) => Object.assign(this.collectionInstance(), json))
  }

  // public save (resource: ResourceInterface) {
  //   console.log(resource)
  // }

  protected abstract resource(): string;

  protected abstract collectionInstance(): ResourceCollectionInterface
}
