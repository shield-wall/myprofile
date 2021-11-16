import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { ResourceCollectionInterface } from '~/resources/contracts/resource.collection.interface'
import { ResourceInterface } from '~/resources/contracts/resource.interface'

export abstract class AbstractRepository {
  private axios: NuxtAxiosInstance;

  constructor ($axios: NuxtAxiosInstance) {
    this.axios = $axios
  }

  public all () {
    return this
      .axios
      .get<ResourceCollectionInterface>(this.resource())
      .then((response: any) => response.data)
      .then((json: any) => Object.assign(this.collectionInstance(), json))
  }

  public save (resource: ResourceInterface) {
    console.log(resource)
  }

  protected abstract resource(): string;

  protected abstract collectionInstance(): ResourceCollectionInterface
}
