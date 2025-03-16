# Domine Listas Ligadas Simples em PHP com 10 exercícios do LeetCode

Listas ligadas são umas estruturas de dados mais básicas e fundamentais da programação.
Através delas, podemos modelar e resolver uma série de problemas complexos em código. 
Além disso, elas servem de base para outras estruturas, como Pilhas, Filas, Grafos, etc.

Nesse artigo, mostrarei como você pode estudar esse tópico através de 10 exercícios selecionados do LeetCode.

## Sumário

1. Introdução
2. Operações básicas
3. Detecção de ciclos
4. Operações avançadas
5. Classes SPL
6. Exercício final

## 1. Introdução

Uma lista ligada é composta por nós que estão encadeados entre si. 
Ela se assemelha bastante com arrays. 
Mas possui uma diferença fundamental: seus elementos não estão necessariamente em posições sequenciais na memória do computador.

<imagem ilustrando um array na memória x imagem ilustrando uma lista na memória>

Por conta disso, não temos acesso randômico aos elementos de uma lista. 
A princípio, para encontrar qualquer dado na lista, é necessário percorrer ela por inteiro, de forma sequencial.

Mas essa estrutura apresenta algumas vantagens, como por exemplo:
- uso flexível da memória (não é necessário alocar um grande espaço sequencial na RAM)
- inserção e remoção mais eficientes: nos arrays é necessário deslocar todos os elementos a partir da posição em que você deseja inserir ou remover um elemento
- tamanho dinâmico: você não precisa se preocupar em definir e gerenciar o tamanho de uma lista. Essa característica pode não parecer ser tão relevante no PHP, visto que os arrays do PHP são dinâmicos por natureza. 
Mas a verdade é que o array do PHP não é bem um array e sim um mapa ordenado. Mas isso é assunto para outro momento.

Cada nó de uma lista é composto por duas partes: 
1. Dados
2. Ponteiro para o próximo nó. 

<imagem ilustrando o nó e suas conexões>

As listas ligadas possui dois nós especiais: a cabeça e a calda.

- A cabeça(head) é o primeiro nó da lista. A partir dele, podemos percorrer toda a lista e executar as operações.
- A calda é o último nó da lista. 
  - Normalmente o seu ponteiro aponta para `null` e com isso, sabemos que a lista termina aqui. 
  - Mas existe um caso especial, que é da lista circular, onde a calda aponta para outro nó da lista, formando um ciclo. 

E por fim as listas podem ser divididas em:
- Simplesmente ligadas
- Duplamente ligadas

Nesse artigo, focarei exclusivamente nas **listas simplesmente ligadas**. 

## 2. Operações básicas

- 2.1 Atravessar a lista
- 2.2 Adicionar um nó na lista
- 2.3 Remover um nó da lista


### 2.1 Atravessar a lista
Atravessar a lista não tem segredo: você começa na cabeça/head e termina na calda/tail.

```php
class Node {
    public $data;
    public $next;
}

class LinkedList {
    // ...
    
    function traverse(Node $head) {
      $current = $head;
      
      while ($current) {
          // Faça algo
          $current = $current->next;
      }
    }
}
```

Por conta de sua característica, a lista não permite acesso randômico. Então para acessar um elemento específico, temos que percorrer toda a lista no pior caso. 
Por conta disso, toda leitura feita na lista tem complexidade de execução de O(n).

### 2.2 Adicionar nó na lista

Para adicionar um nó na lista, você deve identificar a posição onde deseja adicioná-lo e alterar a referência do nó anterior. 

O trecho de código abaixo mostra um exemplo para adicionar o nó no início da lista:

```php
class LinkedList {
    // ...
    public function addAtHead($value)
    {
        if ($this->head === null) {
            $this->head = new Node($value);
        } else {
            $node = new Node($value, $this->head);
            $this->head = $node;
        }
    }
}
```

Para essa operação, temos que nos preocupar se a cabeça da lista existe ou não. 
Caso não exista, o nó é adicionado nela. 
Caso exista, nós criamos um novo nós que aponta para a cabeça da lista e depois modificamos a definimos esse nó como a nova cabeça da lista. 


### 2.2 Remover um nó da lista

Para remover o nó da lista, pegamos o nó anterior e alteramos o `next` dele para apontar para o `next` do nó a ser removido.
Dessa forma, o nó para de ser referenciado na lista e não faz mais parte dela. 

```php
    public function removeAtIndex($index)
    {
        $current = $this->head;
        $prev = null;
        $count = 0;

        while ($current) {
            if ($count === $index) {
                if ($prev === null) {                 
                    $this->head = $this->head->next; // Remove a cabeça da lista
                } else {
                    $prev->next = $current->next; // Remove qualquer outro nó
                }

                break;
            }

            $count++;
            $prev = $current;
            $current = $current->next;
        }
    }
```

Exercícios:

- Leetcode 707: Design Linked List
  - link
  - solução
- Leetcode 234: Palindrome Linked List
  - link
  - solução
- Leetcode 328: Odd Even Linked List
  - link
  - solução
- Leetcode 19: Remove Nth Node From End of List
  - link
  - solução
- Leetcode 203: Remove Linked Lists Elements
  - link
  - solução


## 3. Detecção de ciclos

<desenvolver o conceito de listas circulares e o problema de detecção de ciclos>

Uma lista é definida como circular caso sua calda aponte para outro nó da lista.

<imagem exemplificando listas circulares: um circulo perfeito e um circulo com "calda" >

Uma lista pode tanto ser totalmente circular como ter apenas um segmento circular.  

<algoritmo de Floyd>

### 3.1 Detecção de ciclos com Algoritmo de Floyd

O algoritmo de Floyd utiliza a abordagem de dois ponteiros para resolver esse problema.
Também conhecido como, "A Lebre e a Tartaruga", nesse algoritmo, percorremos a lista iterando dois ponteiros ao mesmo tempo:
  - Um ponteiro mais rápido, conhecido como `fast`, que avança de dois em dois nós
  - Um ponteiro mais lento, conhecido como `slow`, que avança de um em um nó. 

Se o ponteiro mais rápido eventualmente alcançar o estado `null`, isso significa que a lista não era circular. 

Mas caso o ponteiro mais rápido nunca fique `null`, é porque ele está preso num ciclo. 

Por conta disso que avançamos também o ponteiro mais lento. 

Caso os dois eventualmente voltem a se encontrar, é porque a lista possui um ciclo. 

```php
public function hasCycle(): bool
{
    $fast = $slow = $this->head;

    while ($fast && $fast->next) {
        $slow = $slow->next;
        $fast = $fast->next->next;

        if ($slow === $fast) return true;
    }

    return false;
}
```

### 3.1 Detecção de ciclos com Algoritmo de Brent

O algoritmo de Brent também utiliza a abordagem de dois ponteiros.
Contudo a lógica de iteração dele é um pouco diferente.

<detalhar a lógica do Algoritmo de Brent>

### Mediana da lista

É possível adaptar o algoritmo de Floyd para encontrar o nó posicionado no meio de uma lista.

```php
public function getMiddleNode()
{
    $fast = $slow = $this->head;

    while ($fast && $fast->next) {
        $slow = $slow->next;
        $fast = $fast->next->next;
    }

    return $slow;
}
```

Exercícios:
- Leetcode 141: Linked List Cycle
- Leetcode 142: Linked List Cycle II
- Leetcode 876: Middle of Linked List
- Leetcode 2095: Delete the Middle Node of a Linked List

## 5. Rotação de listas

A rotação de uma lista é muito simples.
- Para rotacionar à direita, basta remover o nó da calda e inserí-lo na cabeça. 
- Para rotacionar à esquerda, o contrário se aplica: basta remover o nó da cabeça e inserí-lo na calda. 

- Exercícios:
- Leetcode 61: Rotate Linked List

<ler esse texto: https://www.geeksforgeeks.org/rotate-a-linked-list/>

## 4. Inversão de listas

Para inverter uma lista, existem diversas abordagem.
Uma delas é percorrer a lista do começo ao fim e adicionar todos os nós, um de cada vez, na cabeça da lista.

Exercícios:
- Leetcode 206: Reverse Linked List