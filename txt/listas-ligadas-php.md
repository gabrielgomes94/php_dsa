# Aprenda Listas Ligadas com PHP e 10 exercicios do LeetCode

Roteiro
- Conceitos básicos de forma resumida
- Operações básicas
- Leetcode 707 [1]
- Leetcode 328 [2]
- Leetcode 203 [3]
- Detecção de ciclos
- Leetcode 141 [4]
- Leetcode 142 [5]
- Operações avançadas: encontrar o nó do meio, inverter a lista, rotacionar a lista
- Leetcode 876 [6]
- Leetcode 2095 [7]
- Leetcode 206 [8]
- Leetcode 61 [9]
- Leetcode 160 [9]
- Exercício final: implementar 

---

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
5. SPL classes
6. Exercício final

## 1. Introdução

Uma lista ligada é composta por nós que estão encadeados entre si. 
Ela se assemelha bastante com arrays. 
Mas possui uma diferença fundamental: seus elementos não estão necessariamente em posições sequenciais na memória do computador.

Por conta disso, não temos acesso randômico aos elementos de uma lista. 
A princípio, para encontrar qualquer dado na lista, é necessário percorrer ela por inteiro, de forma sequencial.

Mas essa estrutura apresenta algumas vantagens, como por exemplo:
- uso flexível da memória (não é necessário alocar um grande espaço sequencial na RAM)
- inserção e remoção mais eficientes
- tamanho dinâmico: essa característica pode não parecer ser tão relevante no PHP, visto que os arrays do PHP são dinâmicos por natureza. 
Mas a verdade é que o array do PHP não é bem um array e sim um mapa ordenado. Mas isso é assunto para outro momento.

Cada nó de uma lista é composto por duas partes: 
1. Dados
2. Ponteiro ou referência para o próximo nó. 

<imagem ilustrando o nó e suas conexões>

A lista ligadas possui dois nós especiais: a cabeça e a calda.

- A cabeça(head) é o primeiro nó da lista. A partir dele, podemos percorrer toda a lista e executar as operações.
- A calda é o último nó da lista. 
  - Normalmente o seu ponteiro aponta para `null` e com isso, sabemos que a lista termina aqui. 
  - Mas existe um caso especial, que é da lista circular, onde a calda aponta para outro nó da lista, formando um ciclo. 

E por fim as listas podem ser divididas em:
- Simplesmente ligadas
- Duplamente ligadas

Nesse artigo, focarei exclusivamente nas **listas simplesmente ligadas**. 

## 2. Operações básicas

- Atravessar a lista
- Adicionar um nó na lista
- Remover um nó da lista


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

<desenvolver um pouco cada tópico>

Exercícios:

- Leetcode 707: Design Linked List
- Leetcode 234: Palindrome Linked List
- Leetcode 328: Odd Even Linked List
- Leetcode 19: Remove Nth Node From End of List
- Leetcode 203: Remove Linked Lists Elements


## 3. Detecção de ciclos

<desenvolver o conceito de listas circulares e o problema de detecção de ciclos>

Uma lista é definida como circular caso sua calda aponte para outro nó da lista

<algoritmo de Floyd>

Exercícios:
- Leetcode 141: Linked List Cycle
- Leetcode 142: Linked List Cycle II
- Leetcode 876: Middle of Linked List
- Leetcode 2095: Delete the Middle Node of a Linked List

## 5. Rotação de listas

Exercícios:
- Leetcode 61: Linked List Cycle

## 4. Inversão de listas

Exercícios:
- Leetcode 206: Reverse Linked List